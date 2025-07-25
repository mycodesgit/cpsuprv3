<script>
    function updateNotificationBlink() {
        const notifCount = document.getElementById('notifCount');
        const count = parseInt(notifCount.innerText);

        if (count > 0) {
            notifCount.classList.add('blink');
        } else {
            notifCount.classList.remove('blink');
        }
    }

    // Run it on page load
    document.addEventListener('DOMContentLoaded', updateNotificationBlink);

    // Optional: Call this again after AJAX updates
    // Example: updateNotificationBlink(); after count update
</script>

<script>
    $(document).ready(function() {
        function fetchNotifications() {
            $.ajax({
                url: "{{ route('notifications.fetch') }}", 
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#notifCount').text(data.unread_count > 0 ? data.unread_count : '0');

                    let unreadNotifItems = $('#unreadNotifItems');
                    let readNotifItems = $('#readNotifItems');
                
                    unreadNotifItems.empty();
                    readNotifItems.empty();
                    // Add Unread Notifications
                    if (data.unread.length > 0) {
                        data.unread.forEach(function(notif) {
                            let notifItem = `<a href="#" class="dropdown-item dropdown-item-unread notification-item unread" 
                                data-id="${notif.id}">
                                <i class="fas fa-bell icon text-success"></i>
                                <div class="dropdown-item-desc">
                                    <strong>${notif.message}</strong>
                                    <div class="notification-time">${notif.time_ago}</div>
                                </div>
                            </a>`;
                            unreadNotifItems.append(notifItem);
                        });
                    } else {
                        unreadNotifItems.append('<a href="#" class="dropdown-item text-center text-muted">No new notifications</a>');
                    }
                    // Add Read Notifications
                    if (data.read.length > 0) {
                        data.read.forEach(function(notif) {
                            let notifItem = `<a href="#" class="dropdown-item dropdown-item notification-item read" 
                                data-id="${notif.id}">
                                <i class="fas fa-check-circle icon text-success"></i>
                                <div class="dropdown-item-desc">
                                    ${notif.message}
                                    <div class="notification-time">${notif.time_ago}</div>
                                </div>
                            </a>`;
                            readNotifItems.append(notifItem);
                        });
                    }
                    // Hide sections if empty
                    $('#unreadNotifSection').toggle(unreadNotifItems.children().length > 0);
                    $('#readNotifSection').toggle(readNotifItems.children().length > 0);
                }
            });
        }

        // Mark notification as read when clicked
        $(document).on('click', '.notification-item.unread', function() {
            let notifId = $(this).data('id');
            let clickedItem = $(this);

            $.ajax({
                url: "{{ route('notifications.markAsRead') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: notifId
                },
                success: function() {
                    clickedItem.removeClass('unread').addClass('read');
                    fetchNotifications(); // Refresh UI
                }
            });
        });

        // Fetch notifications every 5 seconds
        setInterval(fetchNotifications, 5000);
        fetchNotifications();
    });
</script>