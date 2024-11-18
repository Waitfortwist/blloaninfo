<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বাংলালিংক লোন তথ্য</title>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes glowBlue {
            0% { color: #0ff; text-shadow: 0 0 5px #0ff, 0 0 10px #0ff, 0 0 15px #0ff, 0 0 20px #00f; }
            50% { color: #0f0; text-shadow: 0 0 10px #0f0, 0 0 20px #0f0, 0 0 30px #0f0, 0 0 40px #0f0; }
            100% { color: #0ff; text-shadow: 0 0 5px #0ff, 0 0 10px #0ff, 0 0 15px #0ff, 0 0 20px #00f; }
        }

        body {
            background-color: #000;
            color: #f00;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            animation: fadeIn 1s ease-out;
        }

        .container {
            max-width: 500px;
            padding: 20px;
            background-color: #111;
            border: 1px solid #f00;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(255,0,0,0.3);
            text-align: center;
            animation: fadeIn 1.5s ease-out;
        }

        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background-color: #000;
            border-radius: 50%;
            position: relative;
            border: 4px solid transparent;
            animation: glowBlue 1.5s infinite;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            width: 80%;
            height: 80%;
            border-radius: 50%;
        }

        form {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            position: absolute;
            left: 10px;
            top: 10px;
            transition: all 0.3s ease;
            pointer-events: none;
            color: #f00;
        }

        input[type="text"] {
            width: calc(100% - 18px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #f00;
            border-radius: 4px;
            background-color: #000;
            color: #f00;
            transition: box-shadow 0.3s ease;
            text-align: center;
        }

        input[type="text"]:focus + label,
        input[type="text"]:not(:placeholder-shown) + label {
            top: -20px;
            left: 10px;
            font-size: 12px;
            color: #f00;
        }

        input[type="text"]:focus {
            box-shadow: 0 0 10px rgba(255,0,0,0.8);
            outline: none;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #000;
            color: #f00;
            border: 1px solid #f00;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            margin-top: 19px;
        }

        button:hover {
            background-color: #f00;
            color: #000;
            box-shadow: 0 0 15px rgba(255,0,0,0.8);
        }

        #responseOverlay {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #f00;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.6);
            text-align: left;
            display: none;
            animation: fadeIn 1s ease-out;
        }

        #responseContent {
            color: #0ff;
            font-size: 16px;
            animation: glowBlue 2s infinite;
        }

        .developer {
            text-align: center;
            margin-top: 20px;
            animation: glowBlue 2s infinite;
        }

        .separator {
            border-top: 1px solid #f00;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://i.ibb.co/jhMSR0T/IMG-20240814-141315.png" alt="Logo">
        </div>
        <h2>BANGLALINK LOAN INFO</h2>
        <div class="separator"></div>
        <br>
        <form id="checkForm">
            <input type="text" id="phoneNumber" name="number" placeholder=" " required>
            <label for="phoneNumber">NUMBER: 019XXXXXXXX</label>
            <button type="submit">GET INFO</button>
        </form>
        <div id="responseOverlay">
            <div id="responseContent"></div>
            <div class="developer">
                Developer: <a href="https://t.me/BLACKCYBERTEAM1">https://t.me/BLACKCYBERTEAM1</a>
            </div>
        </div>
    </div>

    <script>
        function showOverlay(message, isError = false) {
            const responseOverlay = document.getElementById('responseOverlay');
            const responseContent = document.getElementById('responseContent');
            responseContent.innerHTML = `<div class="${isError ? 'error' : ''}">${message}</div>`;
            responseOverlay.style.display = 'block';
        }

        document.getElementById('checkForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var phoneNumber = document.getElementById('phoneNumber').value;

            if (!/^019/.test(phoneNumber)) {
                showOverlay('ত্রুটি: এটি বাংলালিংক নম্বর নয়।', true);
                return;
            }

            var apiUrl = "https://myblapi.banglalink.net/api/v1/emergency-balance/" + encodeURIComponent(phoneNumber);

            fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                if (data.status === "SUCCESS") {
                    const loanInfo = data.data;

                    if (loanInfo.id === undefined || loanInfo.msisdn === undefined || loanInfo.due_loan === undefined || loanInfo.expires_in === undefined) {
                        showOverlay('Not:এই নাম্বারে লোন নেওয়া হয়নি।💰', true);
                    } else {
                        const infoHtml = `
                            <div><strong>আইডি:</strong> ${loanInfo.id}</div>
                            <div><strong>ফোন নম্বর:</strong> ${loanInfo.msisdn}</div>
                            <div><strong>বকেয়া লোন:</strong> ${loanInfo.due_loan} টাকা</div>
                            <div><strong>মেয়াদ শেষের তারিখ:</strong> ${loanInfo.expires_in}</div>
                        `;
                        showOverlay(infoHtml);
                    }
                } else {
                    showOverlay('ত্রুটি: তথ্য প্রদানে সমস্যা হয়েছে।', true);
                }
            })
            .catch(error => {
                showOverlay('ত্রুটি: সার্ভারের সমস্যা রয়েছে, কিছুক্ষণ পর আবার চেষ্টা করুন।', true);
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
