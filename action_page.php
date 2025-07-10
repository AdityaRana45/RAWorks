<?php
$name = $_POST['name'];
$contact = $_POST['contact'];
$company = $_POST['company'];
$service = $_POST['service']; // Optional field

$conn = new mysqli('localhost', 'root', '', 'project');

if ($conn->connect_error) {
    echo "<script>alert('Connection failed: " . $conn->connect_error . "');</script>";
} else {
    $stmt = $conn->prepare("INSERT INTO userdata (Name, Contact, Company, Service) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('siss', $name, $contact, $company, $service);

    if ($stmt->execute()) {
        // Show success popup HTML and JS
        echo '
        <style>
            .popup-overlay {
                position: fixed;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background: rgba(0,0,0,0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
                animation: fadeIn 0.3s ease-in-out;
            }
            .popup-content {
                background: #fff;
                padding: 30px 40px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                animation: scaleIn 0.4s ease-in-out;
                max-width: 400px;
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes scaleIn {
                from {
                    transform: scale(0.7);
                    opacity: 0;
                }
                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }
            .popup-btn {
                margin-top: 20px;
                padding: 10px 20px;
                background: #2ecc71;
                color: white;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background 0.3s;
                font-size: 16px;
            }
            .popup-btn:hover {
                background: #27ae60;
            }
            .home-btn {
                margin-top: 10px;
                background: #3498db;
            }
            .home-btn:hover {
                background: #2980b9;
            }
        </style>

        <div class="popup-overlay" id="success-popup">
            <div class="popup-content">
                <h2>Success!</h2>
                <p>Your slot has been booked successfully.</p>
                <button class="popup-btn" onclick="document.getElementById(\'success-popup\').style.display=\'none\'">OK</button><br>
                <a href="index.html"><button class="popup-btn home-btn">Return to Home</button></a>
            </div>
        </div>
        ';
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
