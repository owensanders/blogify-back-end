<h1>Blogify Back End</h1>

<p><strong>Blogify</strong> is a simple blog platform, where you can create, edit, and delete posts. You can also view other users' posts and like and comment on them.</p>
<p>This is the back-end of my Blogify project, which uses Laravel as a REST API and follows some aspects of clean code architecture, including: Use cases, Repositories, Contracts (interfaces), Data Transfer Objects (DTO), and DTO Factories.</p>
<p>The main concept I am showcasing here is abstraction and separation of concerns by organizing the code into smaller, more manageable components.</p>

<h2>Prerequisites</h2>
<p>You will need to have Docker/Docker Desktop installed, or Composer and PHP to run this API.</p>

<h2>Getting Started</h2>
<p>To start the project, follow these steps:</p>

<ol>
  <li>
    <p><strong>Set up the environment</strong> by copying the example environment file:</p>
    <pre><code>cp .env.example .env</code></pre>
  </li>
  
  <li>
    <p><strong>Install all dependencies:</strong></p>
    <pre><code>composer install</code></pre>
  </li>
  
  <li>
    <p><strong>Run the migrations and seed the database:</strong></p>
    <pre><code>php artisan migrate:fresh --seed</code></pre>
    <p>Then, to start the app, run:</p>
    <pre><code>php artisan serve</code></pre>
  </li>
  
  <li>
    <p>If you don't have Composer installed on your computer, or if you want to use Docker, you can run:</p>
    <pre><code>cd /path/to/the/laravel/project</code></pre>
    <pre><code>docker run --rm -v $(pwd):/app -w /app composer install</code></pre>
  </li>
  
  <li>
    <p><strong>Spin up Docker containers:</strong></p>
    <pre><code>./vendor/bin/sail up</code></pre>
  </li>
  
  <li>
    <p><strong>Run the migrations and seed the database:</strong></p>
    <pre><code>./vendor/bin/sail artisan migrate --seed</code></pre>
  </li>
  
  <li>
    <p><strong>Run feature/unit tests:</strong></p>
    <p>You can run tests either by:</p>
    <pre><code>./vendor/bin/sail artisan test</code></pre>
    <p>Or:</p>
    <pre><code>php artisan test</code></pre>
  </li>
</ol>
