<h1>Blogify Back End</h1>
<p>This is the back-end of my Blogify project, it uses Laravel as a REST API and some aspects of clean code architecture.</p>
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
    <p>To run tests either run:</p>
    <code>./vendor/bin/sail artisan test</code>
    <p>Or...</p>
    <code>php artisan test</code>
</ol>
