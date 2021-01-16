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
User user@cidemo.com user@123
Admin admin@cidemo.com admin@123
Super Admin (Manager) superadmin@cidemo.com superadmin@123

## Subject
Sports
Politics
AI / ML

## Messages
Test A - By user for Sports
Test B - By user for Politics
Test C - By admin for Sports

# Subject Admin
Sports - Admin

## Message Visibility
User - Test A, Test B
Admin - Test A, Test C
Super Admin - Test A, Test B, Test C
