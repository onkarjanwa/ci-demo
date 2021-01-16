# CI Demo APP

# Domain Models

## User
1. name
2. email
3. password
4. is_super_admin

## Subject
1. name

## Message
1. text
2. subject_id
3. created_by
4. status (active/deleted)

# Relations

## User Message Relation <one-to-many>

## Subject Access
1. subject_id
2. user_id
3. access_type enum('admin')

# Sample data

## User
1. User user@cidemo.com user@123
2. Admin admin@cidemo.com admin@123
3. Super Admin (Manager) superadmin@cidemo.com superadmin@123

## Subject
1. Sports
2. Politics
3. AI / ML

## Messages
1. Test A - By user for Sports
2. Test B - By user for Politics
3. Test C - By admin for Sports

# Subject Admin
1. Sports - Admin

## Message Visibility
1. User - Test A, Test B
2. Admin - Test A, Test C
3. Super Admin - Test A, Test B, Test C

# How to setup on local
1. Close repo on your local dev machine
2. cd ci-demo
3. composer install
4. Create .env file in root folder and Add below config
   1. database.default.hostname = '';
   2. database.default.database = '';
   3. database.default.username = '';
   4. database.default.password = '';
   5. database.default.DBDriver = '';
5. php spark migrate
6. php spark db:seed UserSeeder
7. php spark db:seed SubjectSeeder
8. php spark db:seed MessageSeeder
9. php spark db:seed SubjectAccessSeeder
10. php spark serve
11. Access APP on http://localhost:8080
