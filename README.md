## About This Project

This is a calculator application (based on emojis) built using Laravel and ReactJS supporting the initial set of calculations:

-   👽 Addition (Alien U+1F47D)
-   💀 Subtraction (Skull U+1F480)
-   👻 Multiplication (Ghost U+1F47B)
-   😱 Division (Scream U+1F631)

Laravel server-side provides an API for performing the necessary validation and calculation and ReactJS uses the API to build the calculator.

## Deploying The Project

-   Clone this git repository.

    git clone https://github.com/nirnoy112/emoji-based-calculator.git

-   Go to project directory and install the required dependencies.

    cd emoji-based-calculator

    composer install

-   Create a .env file by copying the .env.example file and generate an appliacation key.

    copy .env.example .env

    php artisan key:generate

-   Run NPM commands for ReactJS installation.

    npm install

    npm run dev

-   Start the Laravel development server.

    php artisan serve

-   Finally, check the application navigating to:

    http://127.0.0.1:8000
