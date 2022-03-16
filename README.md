###Tools
Frontend: VueJs 3
Backend: Laravel (version 8.83.4)
Rest API

Application installation
Clone the project from github link - https://github.com/KaisarJamil/laravel_vue_app

      Backend
Go to project directory and copy .env.example into .env
Connect the mysql database with the project
Run php artisan key:generate and php artisan migrate:fresh –seed
Run php artisan serve or valet open(for linux)

      Frontend
Go to the /vue directory of the project
Run npm install 
Run npm run dev
Access the project in browser from http://localhost:3000/

Default Credentials For Login
For Admin Role
Email: admin@mail.com
Password: password

For User Role
Email: user@mail.com
Password: password

*Admin can see, alter all of his/her task lists including all other user, while user can only see his/her task lists. 
*All the user while registering, will get role_id=2 means user role by default 
