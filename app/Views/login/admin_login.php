<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80') center/cover no-repeat fixed;
            position: relative;
            overflow-x: hidden;
        }
        /* Layer blur putih di seluruh background */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            background: rgba(255,255,255,0.70);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .login-card {
            position: relative;
            z-index: 1;
            border: none;
            border-radius: 2rem;
            box-shadow: 0 10px 40px 0 rgba(31, 38, 135, 0.18), 0 0 32px 0 #56CCF233;
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            overflow: hidden;
            animation: fadePop 1s cubic-bezier(.23,1.01,.32,1) 1;
        }
        @keyframes fadePop {
            0% { opacity: 0; transform: scale(0.95) translateY(60px);}
            70% { opacity: 1; transform: scale(1.05) translateY(-10px);}
            100% { opacity: 1; transform: scale(1) translateY(0);}
        }
        .neon-circle {
            width: 88px;
            height: 88px;
            margin: 0 auto 18px auto;
            background: linear-gradient(135deg, #56CCF2 0%, #2F80ED 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 32px 0 #56CCF2, 0 0 0 8px #fff inset;
            border: 4px solid #fff;
            position: relative;
            animation: neonCircle 1.2s cubic-bezier(.23,1.01,.32,1);
        }
        @keyframes neonCircle {
            0% { filter: blur(2px) brightness(0.7);}
            100% { filter: blur(0) brightness(1);}
        }
        .neon-circle i {
            font-size: 2.7rem;
            color: #fff;
            filter: drop-shadow(0 0 8px #56CCF2);
            animation: neonIconPulse 1.7s infinite alternate;
        }
        @keyframes neonIconPulse {
            0% { filter: drop-shadow(0 0 8px #56CCF2);}
            100% { filter: drop-shadow(0 0 18px #2F80ED);}
        }
        .login-title {
            font-weight: 900;
            letter-spacing: 1.5px;
            color: #2F80ED;
            margin-bottom: 0.5rem;
            font-size: 1.7rem;
            text-shadow: 0 2px 8px #2F80ED33;
        }
        .login-desc {
            font-size: 1.09rem;
            color: #4a5a6a;
            margin-bottom: 1.7rem;
            font-weight: 500;
        }
        .form-label {
            font-weight: 700;
            color: #2F80ED;
            letter-spacing: 0.2px;
        }
        .form-control {
            border-radius: 2rem;
            padding: 0.85rem 1.2rem;
            font-size: 1.08rem;
            background: rgba(255,255,255,0.93);
            border: 2px solid #e3eafc;
            color: #222;
            box-shadow: 0 1px 8px rgba(86,204,242,0.05);
            transition: border 0.18s, box-shadow 0.18s;
        }
        .form-control:focus {
            border-color: #56CCF2;
            box-shadow: 0 0 0 2px #2F80ED55, 0 1px 16px #56CCF2;
            background: rgba(255,255,255,0.98);
            color: #222;
        }
        .btn-login {
            background: linear-gradient(90deg, #56CCF2 0%, #2F80ED 100%);
            color: #fff;
            font-weight: 800;
            border: none;
            border-radius: 2rem 0.5rem 2rem 0.5rem;
            padding: 1rem 1.3rem;
            font-size: 1.19rem;
            margin-top: 0.9rem;
            transition: 0.18s;
            box-shadow: 0 4px 18px 0 #56CCF2cc;
            letter-spacing: 1.2px;
            text-shadow: 0 1px 8px #2F80ED88;
        }
        .btn-login:hover, .btn-login:focus {
            background: linear-gradient(90deg, #2F80ED 0%, #56CCF2 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 8px 36px 0 #2F80EDcc;
        }
        .alert {
            border-radius: 1.2rem;
        }
        .password-label-custom {
            font-weight: 700;
            color: #2F80ED;
            letter-spacing: 0.5px;
            font-size: 1.09rem;
            margin-bottom: 0.4rem;
            text-align: left;
        }
        .password-group {
            position: relative;
            display: flex;
            align-items: center;
        }
        .form-control[type="password"], .form-control[type="text"] {
            padding-right: 48px;
        }
        .toggle-password {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #56CCF2;
            font-size: 1.35rem;
            z-index: 2;
            background: none;
            border: none;
            outline: none;
            transition: color 0.15s;
        }
        .toggle-password:hover {
            color: #2F80ED;
        }
        .footer-tiny {
            color: #4a5a6a;
            font-size: 0.97em;
            text-align: center;
            margin-top: 2.5rem;
            letter-spacing: 0.5px;
            font-weight: 400;
            user-select: none;
            text-shadow: 0 1px 8px #2F80ED33;
        }
        @media (max-width: 500px) {
            .login-card .card-body {
                padding: 1.3rem 0.6rem 1.2rem 0.6rem;
            }
            .login-title {
                font-size: 1.13rem;
            }
            .neon-circle {
                width: 54px;
                height: 54px;
            }
            .neon-circle i {
                font-size: 1.7rem;
            }
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh; position:relative; z-index:1;">
    <div class="login-card card shadow p-0" style="width: 410px; max-width: 97vw;">
        <div class="card-body">
            <div class="neon-circle mb-2">
                <i class="bi bi-terminal"></i>
            </div>
            <h3 class="text-center mb-1 login-title">ADMIN AREA</h3>
            <div class="login-desc text-center mb-3">Akses eksklusif untuk admin sistem<br><span style="font-size:0.96em;color:#2F80ED;font-weight:600;">Pringsewu</span></div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/admin') ?>" method="post" autocomplete="off">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" required value="<?= old('email') ?>" placeholder="Masukkan email admin">
                </div>
                <div class="password-label-custom">Password</div>
                <div class="mb-3 password-group">
                    <input type="password" name="password" class="form-control" id="password-input" required placeholder="Masukkan password">
                    <button type="button" class="toggle-password" tabindex="-1" onclick="togglePassword()" aria-label="Lihat Password">
                        <i class="bi bi-eye-slash" id="icon-eye"></i>
                    </button>
                </div>
                <button type="submit" class="btn btn-login w-100">Masuk <i class="bi bi-terminal ms-2"></i></button>
            </form>
        </div>
    </div>
</div>
<div class="footer-tiny">
    &copy; <?= date('Y') ?> <b>Sistem Login Pajak</b> &bull; <span style="color:#2F80ED;">Pringsewu</span>
</div>
<script>
function togglePassword() {
    const input = document.getElementById('password-input');
    const icon = document.getElementById('icon-eye');
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        input.type = "password";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}
</script>
</body>
</html>
