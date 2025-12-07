<!doctype html>
<html lang="lv">
<head>
	<meta charset="utf-8">
	<title>Project 2 - {{ $title }}</title>
	<meta name="description" content="Web Technologies Project 2">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link
	 href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
	 rel="stylesheet"
	 integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
	 crossorigin="anonymous"
	 >
</head>
<body>
	<nav class="navbar navbar-expand-md bg-success mb-3" data-bs-theme="dark">
		<div class="container">
			<span class="navbar-brand mb-0 h1">Project 2</span>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="/">Home</a>
				</li>
				@if(Auth::check())
					<li class="nav-item">
						<a class="nav-link" href="/authors">Izpildītaji</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/albums">Albūmi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/genres">Žanri</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/logout">Beigt darbu</a>
					</li>
				@else
				<li class="nav-item">
					<a class="nav-link" href="/login">Autentificēties</a>
				</li>
				@endif				
				</ul>
			</div>
		</div>
	</nav>

	<main class="container">
		<div class="row">
			<div class="col">
			@yield('content')
			</div>
		</div>
	</main>
	<footer class="text-bg-secondary mt-3">
		<div class="container">
			<div class="row py-5">
				<div class="col">
				Valdis Eizāns, 2025
				</div>
			</div>
		</div>
	</footer>
	
	<script src="/js/admin.js"></script>

</body>
</html>