# simple-blog
Initializing a Project Downloaded from GitHub with Composer

In this guide, we'll walk through the process of initializing a project that you've downloaded from GitHub and setting up its dependencies using Composer.
Prerequisites

Before you get started, make sure you have the following prerequisites installed on your system:

    PHP (version 7.2 or higher)
    Composer (get it from https://getcomposer.org/)
    Git (get it from https://git-scm.com/)

Step 1: Clone the GitHub Repository

Start by cloning the GitHub repository of the project you want to work on. Open your terminal and navigate to the directory where you want to clone the project and run the following command:

```shell

git clone https://github.com/JgregoriDev/simple-blog.git
```
Step 2: Navigate to the Project Directory

Change your current working directory to the project directory you just cloned:

```shell

cd simple-blog
```
Step 3: Check for a composer.json File

Before initializing Composer, check if the project you've downloaded already contains a composer.json file. This file specifies the project's dependencies and configuration. If it's not present, you may need to create one yourself.
Step 4: Initialize Composer

If the project doesn't already have a composer.json file, you can create one using the following command:

```shell

composer init
```
Composer will guide you through the process of creating a composer.json file by asking you a series of questions. Answer them based on your project's requirements.
Step 5: Install Dependencies

Once you have a composer.json file in your project directory (either from the project or one you created in the previous step), you can proceed to install the project's dependencies using Composer:

```shell

composer install
```
Composer will analyze the composer.json file, resolve dependencies, and download the required packages into a vendor directory within your project.
Step 6: Customize and Build
Do you need customize de data from Database in the file
Now that you have the project and its dependencies set up, you can customize and build the project as needed. Refer to the project's documentation or README for specific instructions on how to do this.
Step 7: Run the Project

Finally, run the project using the appropriate command or method specified by the project's documentation or README. This could involve starting a development server, running tests, or executing other project-specific tasks.

Congratulations! You've successfully initialized and set up a project downloaded from GitHub using Composer.
```shell
php -S localhost:3000 -t public/
```
