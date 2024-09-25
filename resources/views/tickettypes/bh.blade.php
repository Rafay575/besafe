<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Business Hours</title>
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Business Hours</h2>
        <button class="btn btn-primary">Add business hours</button>
    </div>
    <div class="card mt-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-1">General working hours <i class="bi bi-lock"></i></h5>
                <p class="card-text text-muted mb-0">(GMT+05:00) Karachi • 3 groups associated</p>
            </div>
            <div>
                <button class="btn btn-link text-dark p-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>