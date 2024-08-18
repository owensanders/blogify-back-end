<h1>Blogify Back End</h1>
<p>This is the back-end of my Blogify project, it uses Laravel as a REST API. <b>It is still a work in progress...</b></p>
<p>To start the project, follow these steps:</p>
<ol>
  <li>Set up the database connection by copying the example environment file:</li>
  <code>cp .env.example .env</code>
  <li>Edit the newly created <code>.env</code> file to configure your database and other environment settings. I have used SQLite if you want to use this tweak the .env to point to your project. Use pwd in the terminal to find the path.</li>
  <li>Run the migrations and seed the database:</li>
  <code>php artisan migrate --seed</code>
  <li>Start the Laravel development server:</li>
  <code>php artisan serve</code>
</ol>
