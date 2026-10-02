<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile, In One Place</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: #f7f6ff;
            color: #202033;
            font-family: Arial, sans-serif;
        }

        a {
            color: inherit;
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            width: min(1120px, calc(100% - 40px));
            margin: 0 auto;
            padding: 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand,
        .login-link {
            color: #5141c7;
            font-weight: 700;
            text-decoration: none;
        }

        .brand {
            font-size: 20px;
        }

        .hero {
            width: min(1120px, calc(100% - 40px));
            flex: 1;
            margin: 0 auto;
            padding: 56px 0 84px;
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(300px, 0.85fr);
            gap: 64px;
            align-items: center;
        }

        .eyebrow {
            margin: 0 0 18px;
            color: #6c5ce7;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 650px;
            margin: 0;
            font-size: clamp(42px, 6vw, 68px);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .intro {
            max-width: 560px;
            margin: 24px 0 32px;
            color: #666579;
            font-size: 18px;
            line-height: 1.7;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .button {
            min-height: 50px;
            padding: 0 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            border-radius: 9px;
            font-weight: 700;
            text-decoration: none;
            transition: background 160ms ease, transform 160ms ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .button-primary {
            background: #6c5ce7;
            color: #fff;
        }

        .button-primary:hover {
            background: #5848d6;
        }

        .button-secondary {
            border-color: #dedbf5;
            background: #fff;
            color: #5141c7;
        }

        .feature-card {
            padding: 34px;
            border: 1px solid #ebe9f8;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(53, 44, 120, 0.1);
        }

        .feature-icon {
            width: 54px;
            height: 54px;
            margin-bottom: 24px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: #efedff;
            color: #6c5ce7;
            font-size: 26px;
        }

        .feature-card h2 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        .feature-card p {
            margin: 0;
            color: #727184;
            line-height: 1.7;
        }

        .feature-list {
            margin: 26px 0 0;
            padding: 0;
            list-style: none;
        }

        .feature-list li {
            padding: 13px 0;
            border-top: 1px solid #f0eff7;
            color: #454456;
        }

        .feature-list li::before {
            margin-right: 10px;
            color: #6c5ce7;
            content: "✓";
            font-weight: 700;
        }

        footer {
            padding: 20px;
            color: #89889a;
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 760px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 42px;
                padding-top: 36px;
            }

            .feature-card {
                padding: 28px;
            }
        }

        @media (max-width: 480px) {
            .topbar,
            .hero {
                width: min(100% - 32px, 1120px);
            }

            .hero {
                padding-top: 24px;
            }

            .intro {
                font-size: 16px;
            }

            .actions {
                flex-direction: column;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <a class="brand" href="signup.php">My Account</a>
            <a class="button button-primary login-link" href="mywebsites/login.php">Log in</a>
        </header>

        <main class="hero">
            <section>
                <p class="eyebrow">A fresh start, made simple</p>
                <h1>Your profile, all in one place.</h1>
                <p class="intro">
                    Create your account, set up your profile, and keep your details
                    together in a personal dashboard that's easy to use.
                </p>
                <div class="actions">
                    <a class="button button-primary" href="mywebsites/signup.php">Create your account</a>
                    <a class="button button-secondary" href="mywebsites/login.php">I already have an account</a>
                </div>
            </section>

            <aside class="feature-card" aria-label="Account features">
                <div class="feature-icon" aria-hidden="true">✦</div>
                <h2>A home for your account</h2>
                <p>Get started in a few steps and see your profile information whenever you need it.</p>
                <ul class="feature-list">
                    <li>One simple profile</li>
                    <li>Your own dashboard</li>
                    <li>Easy account access</li>
                </ul>
            </aside>
        </main>

        <footer>Get started by creating your account.</footer>
    </div>
</body>
</html>
