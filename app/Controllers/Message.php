<?php
namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * Message controller class
 * 
 * @author Onkar
 */
class Message extends Controller {

    /**
     * Create message function
     */
    public function create() {
        $messageModel = new \App\Models\MessageModel();

        $session = $this->getSession();
        $userId = $this->getUserId($session);
        
        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();
            $messageModel->insert([
                'text' => $post['text'],
                'subject_id' => (int)$post['subject_id'],
                'user_id' => (int)$userId,
                'status' => 'active'
            ]);

            $session->setFlashdata('message_create_success', 'Message created successfully.');
        }

        return redirect()->to('/messages');
    }

    /**
     * List message function
     * 
     * It lists messages based on user access (user/super admin).
     * Super Admin - Can see all the posts
     * User 
     *  - Can see his/her own posts
     *  - Can see posts related to subjects if he/she is admin of that subject
     */
    public function list() {
        $session = $this->getSession();
        $userId = $this->getUserId($session);
        $isSuperAdmin = $this->isSuperAdmin($session);

        $messageModel = new \App\Models\MessageModel();
        $subjectAccessModel = new \App\Models\SubjectAccessModel();

        if ($isSuperAdmin) {
            $messages = $messageModel
                ->where('status', 'active')
                ->orderBy('id', 'desc')
                ->findAll(100);
        } else {
            $subjectAccesses = $subjectAccessModel->where('user_id', $userId)->findAll();
            if (!count($subjectAccesses)) {
                $filterParams = [$userId, 'active'];
                $sql = 'SELECT * FROM messages WHERE user_id = ? and status = ? order by id desc';
            } else {
                $subjectIds = [];
                foreach($subjectAccesses as $subjectAccess) {
                    array_push($subjectIds, $subjectAccess['subject_id']);
                }

                $filterParams = [$userId, $subjectIds, 'active'];
                $sql = 'SELECT * FROM messages WHERE (user_id = ? OR subject_id IN ?) and status = ? order by id desc';
            }
            $db = db_connect();
            $messagesQuery = $db->query($sql, $filterParams);
            $messages = [];
            foreach ($messagesQuery->getResult('array') as $message) {
                array_push($messages, $message);
            }
        }

        $subjects = $this->getSubjects();

        $messagesViewData = $this->buildMessageViewData($messages, $subjects);

        return view('message/list', [
            'messages' => $messagesViewData, 
            'subjects' => $subjects,
        ]);
    }

    /**
     * Delete message function
     * 
     * Messages are allowed to be deleted based on user access (user/super admin).
     * Super Admin - Can delete all the posts
     * User 
     *  - Can delete his/her own posts
     *  - Can delete posts related to subjects if he/she is admin of that subject
     */
    public function delete(int $messageId) {
        $session = $this->getSession();
        $userId = $this->getUserId($session);
        $isSuperAdmin = $this->isSuperAdmin($session);

        $messageModel = new \App\Models\MessageModel();
        $subjectAccessModel = new \App\Models\SubjectAccessModel();

        if ($isSuperAdmin) {
            $message = $messageModel
                ->where('status', 'active')
                ->where('id', $messageId)
                ->first();
        } else {
            $subjectAccesses = $subjectAccessModel->where('user_id', $userId)->findAll();
            if (!count($subjectAccesses)) {
                $filterParams = [$messageId, $userId, 'active'];
                $sql = 'SELECT * FROM messages WHERE id = ? and user_id = ? and status = ?';
            } else {
                $subjectIds = [];
                foreach($subjectAccesses as $subjectAccess) {
                    array_push($subjectIds, $subjectAccess['subject_id']);
                }

                $filterParams = [$messageId, $userId, $subjectIds, 'active'];
                $sql = 'SELECT * FROM messages WHERE id = ? and (user_id = ? OR subject_id IN ?) and status = ?';
            }
            $db = db_connect();
            $messageQuery = $db->query($sql, $filterParams);
            $message = $messageQuery->getResult('array')[0];
        }

        if ($message) {
            $messageModel->update($messageId, ['status' => 'deleted']);
            $session->setFlashdata('message_delete_success', 'Message has been deleted successfully.');
            return redirect()->to('/messages');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    private function getSubjects() {
        $subjectModel = new \App\Models\SubjectModel();

        return $subjectModel->findAll();
    }

    private function getSession() {
        return session();
    }

    private function getUserId($session) {
        return (int)$session->get('user_id');
    }

    private function isSuperAdmin($session) {
        return $session->get('is_super_admin') == true;
    }

    private function buildMessageViewData($messages, $subjects) {
        $userModel = new \App\Models\UserModel();
        $messagesViewData = [];
        
        $subjectsMap = [];
        foreach($subjects as $subject) {
            $subjectsMap[$subject['id']] = $subject['name'];
        }

        $usersMap = [];

        foreach($messages as $message) {
            if (!isset($usersMap[$message['user_id']])) {
                $user = $userModel->where('id', (int)$message['user_id'])->first();
                $usersMap[$message['user_id']] = $user;
            } else {
                $user = $usersMap[$message['user_id']];
            }

            $messageViewData = [];
            $messageViewData['id'] = $message['id'];
            $messageViewData['text'] = $message['text'];
            $messageViewData['subject_id'] = $message['subject_id'];
            $messageViewData['subject_name'] = $subjectsMap[$message['subject_id']];
            $messageViewData['user_id'] = $message['user_id'];
            $messageViewData['user_name'] = $user['name'];
            array_push($messagesViewData, $messageViewData);
        }

        return $messagesViewData;
    }
}