<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateUserPendingCount() {
            $.get(userPendingCountRoute, function (data) {
                $('#pendingUserCount').text(data.pendUserCount);
            });
        }
        setInterval(updateUserPendingCount, 5000);
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updatePendingCount() {
            $.get(allPendingCountRoute, function (data) {
                $('#pendingCount').text(data.pendCount);
            });
        }
        setInterval(updatePendingCount, 5000);
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateBudPendingCount() {
            $.get(allPendingBudgetCountRoute, function (data) {
                $('#pendingBudCount').text(data.pendBudCount);
            });
        }
        setInterval(updateBudPendingCount, 5000);
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateUserApprovedCount() {
            $.get(userApprovedCountRoute, function (data) {
                $('#approvedUserCount').text(data.approvedUserCount);
            });
        }

        function updateUserReceivedCount() {
            $.get(userApprovedCountRoute, function (data) {
                $('#receivedUserCount').text(data.receivedUserCount);
            });
        }

        function updateUserCanvassingCount() {
            $.get(userApprovedCountRoute, function (data) {
                $('#canvassingUserCount').text(data.canvassingUserCount);
            });
        }

        function updateUserCanvassedCount() {
            $.get(userApprovedCountRoute, function (data) {
                $('#canvassedUserCount').text(data.canvassedUserCount);
            });
        }

        function updateUserPhilGepCount() {
            $.get(userApprovedCountRoute, function (data) {
                $('#philgepUserCount').text(data.philgepUserCount);
            });
        }

        function updateUserPostedCount() {
            $.get(userApprovedCountRoute, function (data) {
                $('#postedUserCount').text(data.postedUserCount);
            });
        }

        function updateUserBiddingCount() {
            $.get(userApprovedCountRoute, function (data) {
                $('#biddingUserCount').text(data.biddingUserCount);
            });
        }

        function updateCounts() {
            updateUserApprovedCount();
            updateUserReceivedCount();
            updateUserCanvassingCount();
            updateUserCanvassedCount();
            updateUserPhilGepCount();
            updateUserPostedCount();
            updateUserBiddingCount();
        }

        setInterval(updateCounts, 5000);
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateApprovedCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#approvedCount').text(data.approvedCount);
            });
        }

        function updateReceivedCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#receivedCount').text(data.receivedCount);
            });
        }

        function updateCanvassingCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#canvassingCount').text(data.canvassingCount);
            });
        }

        function updateCanvassedCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#canvassedCount').text(data.canvassedCount);
            });
        }

        function updatePhilgepCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#philgepCount').text(data.philgepCount);
            });
        }

        function updatePostingCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#postedCount').text(data.postedCount);
            });
        }

        function updateBiddingCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#biddingCount').text(data.biddingCount);
            });
        }

        function updateConsolidateCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#consolidateCount').text(data.consolidateCount);
            });
        }

        function updateAwardCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#awardedCount').text(data.awardedCount);
            });
        }

        function updatePurchaseCount() {
            $.get(allApprovedCountRoute, function (data) {
                $('#purchaseCount').text(data.purchaseCount);
            });
        }

        function updateCounts() {
            updateApprovedCount();
            updateReceivedCount();
            updateCanvassingCount();
            updateCanvassedCount();
            updatePhilgepCount();
            updatePostingCount();
            updateBiddingCount();
            updateConsolidateCount();
            updateAwardCount();
            updatePurchaseCount();
        }

        setInterval(updateCounts, 5000);
    });
</script>