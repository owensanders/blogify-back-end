<h1>Blogify Back End</h1>
<p>Blogify is a simple blog platform, where you can create, edit and delete posts. You can also view other users posts and like and comment on them.</p>
<p>This is the back-end of my Blogify project, it uses Laravel as a REST API and some aspects of clean code architecture. e.g. Use cases, Repositories, Contracts (interfaces), Data Transfer Objects(DTO) and DTO Factories.</p>
<p>Main thing i'm trying to showcase here is abstraction and seperation of concerns by splitting out the code.</p>
<h2>Prerequisite</h2>
<p>You will need to have Docker/Docker Desktop installed or Composer and PHP to run this API.</p>
<p>To start the project, follow these steps:</p>
<ol>
  <li>Set up environment by copying the example environment file:</li>
  <code>cp .env.example .env</code>
    <li>Install all dependencies:</li>
    <code>composer install</code>
    <li>Run the migrations and seed the database:</li>
    <code>php artisan migrate:fresh --seed</code>
    <p>Then finally to start the app run:</p>
    <code>php artisan serve</code>
    <p>If you don't have composer on you computer or you want to use Docker then you can:</p>
    <code>cd /path/to/the/laravel/project</code>
    <code>docker run --rm -v $(pwd):/app -w /app composer install</code>
    <li>Spin up docker containers:</li>
    <code>./vendor/bin/sail up</code>
    <li>Run the migrations and seed the database:</li>
    <code>./vendor/bin/sail artisan migrate --seed</code>
    <p>To run feature/unit tests either run:</p>
    <code>./vendor/bin/sail artisan test</code>
    <p>Or...</p>
    <code>php artisan test</code>
</ol>
