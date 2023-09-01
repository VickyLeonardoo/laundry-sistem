<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap");
        html {
        background-color: #3c339c;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
        font-family: "Lato", sans-serif;
        }

        section {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-around;
        width: 40vw;
        min-width: 350px;
        height: 80vh;
        background-color: white;
        border-radius: 12px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
            rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        padding: 24px 0px;
        }
        svg {
        margin: 16px 0;
        }
        title {
        font-size: 20px;
        font-weight: bold;
        }

        p {
        color: #a3a3a3;
        font-size: 14px;
        width: 200px;
        margin-top: 4px;
        }
        input {
        width: 32px;
        height: 32px;
        text-align: center;
        border: none;
        border-bottom: 1.5px solid #3c339c;
        margin: 0 10px;
        }

        input:focus {
        border-bottom: 1.5px solid grey;
        outline: none;
        }

        button {
        width: 250px;
        letter-spacing: 2px;
        margin-top: 24px;
        padding: 12px 16px;
        border-radius: 8px;
        border: none;
        background-color: #3c339c;
        color: white;
        cursor: pointer;
        }
    </style>
</head>
<body>
    <section>
        @if (session('message'))
            <div class="alert alert-light-success color-success text-danger"><i class="bi bi-check-circle"></i> {{session('message')}}</div>
        @endif
        <div class="title">OTP</div>
        <div class="title">Verification Code</div>
        <a href="{{ route('otp.kirim.ulang') }}">Kirim OTP</a>
        <p>We have sent a verification code to your Email</p>
        <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
            <div id='inputs'>
                <input name="input1" id='input1' type='text' maxLength="1" />
                <input name="input2" id='input2' type='text' maxLength="1" />
                <input name="input3" id='input3' type='text' maxLength="1" />
                <input name="input4" id='input4' type='text' maxLength="1" />
                <input name="input5" id='input5' type='text' maxLength="1" />
                <input name="input6" id='input6' type='text' maxLength="1" />
            </div>
            <button type="submit">Submit</button>
        </form>
      </section>
      <script>
        document.querySelector('form').addEventListener('submit', (event) => {
            const inputs = document.querySelectorAll('#inputs input');
            let isComplete = true;

            inputs.forEach((input) => {
                if (input.value === '') {
                    isComplete = false;
                }
            });

            if (!isComplete) {
                event.preventDefault();
                alert('Please Fill All OTP Column.');
            }
        });
        const inputs = ["input1", "input2", "input3", "input4", "input5", "input6"];
        inputs.map((id) => {
        const input = document.getElementById(id);
        addListener(input);
        });

        function addListener(input) {
        input.addEventListener("keyup", () => {
            const code = parseInt(input.value);
            if (code >= 0 && code <= 9) {
            const n = input.nextElementSibling;
            if (n) n.focus();
            } else {
            input.value = "";
            }

            const key = event.key; // const {key} = event; ES6+
            if (key === "Backspace" || key === "Delete") {
            const prev = input.previousElementSibling;
            if (prev) prev.focus();
            }
        });
        }
      </script>
</body>
</html>
