$(document).ready(function() {
    $('.check-maintenance').on('change', function() {
        
        var applied = $(this).attr('applied');
        var maintenanceId = $(this).attr('maintenanceId');
        if (applied) {
            $(this).attr('applied', false);
        } else {
            $(this).attr('applied', true);
        }
        
        var data = new FormData();
        data.append('applied', applied);
        data.append('maintenanceId', maintenanceId);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'applied',
            data: data,
            method: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
            }
        });
    });
}) 