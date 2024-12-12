<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <script src="../../assets/js/jquery.js"></script>
    <style>
        .chat-container {
            height: calc(100vh - 100px);
            margin: 20px 0;
        }
        .user-list {
            height: 100%;
            overflow-y: auto;
            border-right: 1px solid #dee2e6;
        }
        .user-item {
            cursor: pointer;
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        .user-item:hover {
            background-color: #f8f9fa;
        }
        .chat-box {
            height: calc(100vh - 250px);
            overflow-y: auto;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        .message-form {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2 class="mt-3">Admin Chat</h2>
        <div class="row chat-container">
            <!-- Users List -->
            <div class="col-md-3 user-list">
                <h4>Users</h4>
                <ul id="user-list" class="list-group list-group-flush">
                    <!-- User list will be populated here -->
                </ul>
            </div>

            <!-- Chat Container -->
            <div class="col-md-9">
                <div class="conversation-header">
                    <h4>Conversation <span id="selected-user-name"></span></h4>
                </div>
                <div id="chat-box" class="chat-box"></div>
                <form id="chat-form" class="message-form">
                    <input type="hidden" id="receiver_id">
                    <div class="form-group">
                        <textarea id="message_text" class="form-control" placeholder="Type your message..." rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Define adminId globally
        window.adminId = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="../../assets/js/adminChat.js"></script>
    <script>
        $(document).ready(function() {
            // Keep only user list functionality
            function fetchUsers() {
                $.get('../../backend/adminFUNCTIONS/fetchUsers.php', function(data) {
                    try {
                        const response = JSON.parse(data);
                        if (response.error) {
                            console.error('Error:', response.error);
                            return;
                        }
                        $('#user-list').html('');
                        response.forEach(user => {
                            const userName = `${user.first_name} ${user.last_name} (${user.username})`;
                            $('#user-list').append(`
                                <li class="list-group-item user-item" data-id="${user.user_id}">
                                    ${userName}
                                </li>
                            `);
                        });
                    } catch (e) {
                        console.error('Parse error:', e, 'Raw data:', data);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                });
            }

            fetchUsers();
        });
    </script>
</body>
</html>