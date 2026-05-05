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
                            let notifItem = `
                            <li class="p-3 border-bottom">
                                <a href="#" class="dropdown-item dropdown-item-unread notification-item unread" 
                                data-id="${notif.id}">
                            <div class="d-flex gap-3">
                                <div class="flex-grow-1 small">
                                    <p class="mb-1">${notif.message}</p>
                                    <div class="text-secondary">${notif.time_ago}</div>
                                </div>
                            </div></a>
                            </li>`;
                            unreadNotifItems.append(notifItem);
                        });
                    } else {
                        unreadNotifItems.append('<a href="#" class="dropdown-item text-center text-muted">No new notifications</a>');
                    }
                    // Add Read Notifications
                    if (data.read.length > 0) {
                        data.read.forEach(function(notif) {
                            let notifItem = `
                            <li class="p-3 border-bottom">
                                <a href="#" class="dropdown-item dropdown-item-read notification-item read" 
                                data-id="${notif.id}">
                            <div class="d-flex gap-3">
                                <div class="flex-grow-1 small">
                                    <p class="mb-1">${notif.message}</p>
                                    <div class="text-secondary">${notif.time_ago}</div>
                                </div>
                            </div>
                            </a>
                            </li>`;
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