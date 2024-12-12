<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/userSIDEBAR.css">
    <script src="../../assets/js/jquery.js"></script>
    <style>
        .wrapper {
            display: flex;
        }
        .main-content {
            flex: 1;
            margin-left: 250px; /* Sidebar width */
        }
        .chat-container {
            height: calc(100vh - 200px); /* Reduced height */
            margin: 10px 0; /* Reduced margin */
            display: flex;
            flex-direction: column;
        }
        .chat-box {
            flex: 1;
            height: calc(100vh - 350px); /* Adjusted height */
            overflow-y: auto;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 10px; /* Added margin bottom */
        }
        .message-form {
            margin-top: 10px;
            padding: 10px;
            background: #fff;
        }
        .conversation-header {
            padding: 10px 0;
        }
        /* Reduce text area height */
        #message_text {
            max-height: 100px;
            min-height: 60px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        
        <div class="main-content">
            <!-- Header -->
            <?php include 'userHEADER.php'; ?>
            
            <!-- Chat Content -->
            <div class="container-fluid p-4">
                <h2>Message Admin</h2>
                <div class="row chat-container">
                    <div class="col-md-12">
                        <div id="chat-box" class="chat-box"></div>
                        <form id="chat-form" class="message-form">
                            <input type="hidden" id="receiver_id" value="2">
                            <div class="form-group">
                                <textarea id="message_text" class="form-control" placeholder="Type your message..." rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        window.userId = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="../../assets/js/userChat.js"></script>
</body>
</html>