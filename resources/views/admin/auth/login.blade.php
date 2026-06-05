<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Dnia Organizer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    :root {
        --brand-primary: #9146FF;
        --brand-primary-hover: #A970FF;
        --brand-bg: #F0F2F5;
        --brand-surface: #FFFFFF;
        --brand-text-primary: #212529;
        --brand-text-secondary: #6C757D;
        --brand-border: #DEE2E6;
    }

    body {
        background-color: var(--brand-bg);
        color: var(--brand-text-primary);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .login-card {
        background-color: var(--brand-surface);
        border: 1px solid var(--brand-border);
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .login-header {
        background-color: var(--brand-surface);
        color: var(--brand-text-primary);
        border-bottom: 1px solid var(--brand-border);
        padding: 40px 30px;
        text-align: center;
    }

    .login-header h2 {
        margin: 0;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: var(--brand-primary);
    }

    .login-header p {
        margin: 5px 0 0;
        color: var(--brand-text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.05em;
    }

    .form-label {
        color: var(--brand-text-primary);
        font-weight: 600;
        font-size: 13px;
    }

    .form-control {
        background-color: #FFFFFF;
        border: 1px solid var(--brand-border);
        color: var(--brand-text-primary);
        border-radius: 4px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 2px rgba(145, 70, 255, 0.1);
    }

    .btn-purple {
        background-color: var(--brand-primary);
        color: white;
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 12px;
        transition: all 0.2s ease;
        border-radius: 4px;
        padding: 12px;
    }

    .btn-purple:hover {
        background-color: var(--brand-primary-hover);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(145, 70, 255, 0.2);
    }

    .form-check-label {
        color: var(--brand-text-secondary);
        font-size: 13px;
    }

    .form-check-input:checked {
        background-color: var(--brand-primary);
        border-color: var(--brand-primary);
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <div class="login-header">
                        <h2>Dnia Organizer</h2>
                        <p>Admin Panel</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <button type="submit" class="btn btn-purple w-100 py-2">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>