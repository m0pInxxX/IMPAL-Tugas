<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISP Service Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .popup {
            display: flex;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        .menu-option {
            margin: 10px 0;
        }
        .menu-option button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .menu-option button:hover {
            background-color: #0056b3;
        }
        .cancel-send {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .cancel-send button {
            width: 48%;
            padding: 10px;
            border: none;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .cancel-send button.send {
            background-color: #28a745;
        }
    </style>
    <script>
        let autoTPs = [10000, 20000];  // Example Auto TP values
        
        function showMenu(menuId) {
            document.querySelectorAll('.popup-content').forEach(menu => {
                menu.style.display = 'none';
            });
            document.getElementById(menuId).style.display = 'block';
        }
        
        function transferPulsa() {
            let phoneNumber = prompt('Masukkan nomor tujuan:');
            if (phoneNumber) {
                let amount = prompt('Masukkan nominal pulsa:');
                if (amount) {
                    confirmAction('Transfer Pulsa', phoneNumber, amount);
                }
            }
        }
        
        function autoTP(action) {
            if (action === 'add') {
                let amount = prompt('Masukkan jumlah pulsa untuk Auto TP:');
                if (amount) {
                    confirmAction('Auto TP', null, amount);
                }
            } else if (action === 'delete') {
                if (autoTPs.length > 0) {
                    let tpList = autoTPs.map((tp, index) => (index + 1) + '. Auto TP ' + tp).join('\n');
                    let tpIndex = prompt('Pilih Auto TP yang ingin dihapus:\n' + tpList);
                    if (tpIndex && tpIndex > 0 && tpIndex <= autoTPs.length) {
                        confirmAction('Delete Auto TP', null, autoTPs[tpIndex - 1]);
                    }
                } else {
                    alert('Anda tidak memiliki auto transfer pulsa sekarang.');
                }
            } else if (action === 'list') {
                if (autoTPs.length > 0) {
                    alert('List Auto TP:\n' + autoTPs.map(tp => 'Auto TP ' + tp).join('\n'));
                } else {
                    alert('Anda tidak memiliki auto transfer pulsa sekarang.');
                }
            }
        }

        function cekKupon() {
            let hasCoupon = Math.random() < 0.1;  // 10% chance to get a coupon
            if (hasCoupon) {
                let couponCode = Math.random().toString(36).substring(2, 11).toUpperCase();
                alert('Selamat! Kode kupon undian Anda: ' + couponCode);
            } else {
                alert('Anda tidak memiliki kupon undian sekarang.');
            }
        }

        function confirmAction(actionType, phoneNumber, amount) {
            let confirmation = confirm('Konfirmasi ' + actionType + (phoneNumber ? ' ke ' + phoneNumber : '') + ' dengan nominal ' + amount + '?');
            if (confirmation) {
                let secondConfirmation = confirm('Apakah Anda yakin ingin melanjutkan?');
                if (secondConfirmation) {
                    alert(actionType + ' berhasil dilakukan!');
                }
            }
        }

        function cancel() {
            showMenu('main-menu');
        }

        function sendAction() {
            let choice = prompt("Masukkan nomor menu (1-6):");

            switch (choice) {
                case '1':
                    transferPulsa();
                    break;
                case '2':
                    transferPulsa();  // Bisa diubah ke fungsi "Minta Pulsa" jika ada fungsinya
                    break;
                case '3':
                    autoTP('add');
                    break;
                case '4':
                    autoTP('delete');
                    break;
                case '5':
                    autoTP('list');
                    break;
                case '6':
                    cekKupon();
                    break;
                default:
                    alert("Pilihan tidak valid.");
                    break;
            }
        }
    </script>
</head>
<body>
    <!-- Main Menu -->
    <div class="popup">
        <div id="main-menu" class="popup-content">
            <p>Mau Paket Data Tambahan?</p>
            <p>Hub *500*117#</p>
            <div class="menu-option">
                <button onclick="transferPulsa()">1. Transfer Pulsa</button>
            </div>
            <div class="menu-option">
                <button onclick="transferPulsa()">2. Minta Pulsa</button>
            </div>
            <div class="menu-option">
                <button onclick="autoTP('add')">3. Auto TP</button>
            </div>
            <div class="menu-option">
                <button onclick="autoTP('delete')">4. Delete Auto TP</button>
            </div>
            <div class="menu-option">
                <button onclick="autoTP('list')">5. List Auto TP</button>
            </div>
            <div class="menu-option">
                <button onclick="cekKupon()">6. Cek Kupon Undian TP</button>
            </div>
            <div class="cancel-send">
                <button class="cancel" onclick="cancel()">Cancel</button>
                <button class="send" onclick="sendAction()">Send</button>
            </div>
        </div>
    </div>
</body>
</html>
