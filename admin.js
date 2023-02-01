function showModal(trackNumber) {
    $.ajax({
        url: 'getTrackingHistory.php',
        type: 'POST',
        data: {
            trackNumber: trackNumber
        },
        success: function (data) {
            const trackingHistory = JSON.parse(data);
            console.log(trackingHistory);
            const modalWindow = document.getElementById('exampleModalCenter');
            const modalHeader = modalWindow.querySelector('.modal-header');
            modalHeader.innerHTML = `<h5 class="modal-title">${trackNumber}</h5>`;
            const modalBody = modalWindow.querySelector('.modal-body');


            const timeline = document.createElement('div');
            timeline.classList.add('timeline');

            let lastStatus = '';

            for (let i = 1; i < trackingHistory.length; i++) {
                const timelineElement = document.createElement('div');

                const timelineIcon = document.createElement('i');

                timelineIcon.classList.add('fas', 'fa-solid');

                switch (trackingHistory[i].status) {
                    case 'InTransit':
                        timelineIcon.classList.add('fa-truck', 'bg-secondary');
                        break;
                    case 'Delivered':
                        timelineIcon.classList.add('fa-check-double', 'bg-success');
                        break;
                    case 'AvailableForPickup':
                        timelineIcon.classList.add('fa-box-open', 'bg-warning');
                        break;
                    case 'DeliveryFailure':
                        timelineIcon.classList.add('fa-times', 'bg-danger');
                        break;
                }

                timelineElement.appendChild(timelineIcon);

                const timelineItem = document.createElement('div');
                timelineItem.classList.add('timeline-item');

                const time = document.createElement('span');
                time.classList.add('time');

                const timeIcon = document.createElement('i');
                timeIcon.classList.add('fas', 'fa-clock');
                time.appendChild(timeIcon);

                const timeText = document.createTextNode(trackingHistory[i].dateUpdated);
                time.appendChild(timeText);
                timelineItem.appendChild(time);

                const header = document.createElement('h3');
                header.classList.add('timeline-header');

                lastStatus = trackingHistory[i].status;

                const headerText = document.createTextNode(lastStatus);
                header.appendChild(headerText);
                timelineItem.appendChild(header);

                const timelineBody = document.createElement('div');
                timelineBody.classList.add('timeline-body');
                const bodyText = document.createTextNode(trackingHistory[i].description);
                timelineBody.appendChild(bodyText);

                timelineItem.appendChild(timelineBody);
                timelineElement.appendChild(timelineItem);
                timeline.appendChild(timelineElement);
            }

            const timelineEnd = document.createElement('div');
            const timelineEndIcon = document.createElement('i');

            if (lastStatus === 'Delivered') {
                timelineEndIcon.classList.add('fas', 'fa-check', 'bg-success');
            } else if (lastStatus === 'DeliveryFailure') {
                timelineEndIcon.classList.add('fas', 'fa-times', 'bg-danger');
            } else {
                timelineEndIcon.classList.add('fas', 'fa-clock', 'bg-secondary');
            }

            timelineEnd.appendChild(timelineEndIcon);
            timeline.appendChild(timelineEnd);


            modalBody.innerHTML = '';
            modalBody.append(timeline);

            const trackingInfo = document.createElement('div');
            const trackingInfoRow = document.createElement('div');
            trackingInfoRow.classList.add('row');
            const trackingStatus = document.createElement('div');
            trackingStatus.classList.add('col-12');
            const trackingStatusText = document.createTextNode('Status: ' + trackingHistory[trackingHistory.length - 1].status);
            trackingStatus.appendChild(trackingStatusText);
            trackingInfoRow.appendChild(trackingStatus);
            const trackingDateRegistered = document.createElement('div');
            trackingDateRegistered.classList.add('col-12');
            const trackingDateRegisteredText = document.createTextNode('Date registered: ' + trackingHistory[1].dateUpdated);
            trackingDateRegistered.appendChild(trackingDateRegisteredText);
            trackingInfoRow.appendChild(trackingDateRegistered);
            const trackingDateUpdated = document.createElement('div');
            trackingDateUpdated.classList.add('col-12');
            const trackingDateUpdatedText = document.createTextNode('Date updated: ' + trackingHistory[trackingHistory.length - 1].dateUpdated);
            trackingDateUpdated.appendChild(trackingDateUpdatedText);
            trackingInfoRow.appendChild(trackingDateUpdated);

            const trackingAddress = document.createElement('div');
            trackingAddress.classList.add('col-12');

            const trackingAddressText = document.createTextNode("Address: " + [trackingHistory[0].country, trackingHistory[0].state, trackingHistory[0].city, trackingHistory[0].street, trackingHistory[0].postalCode].join(', '));
            trackingAddress.appendChild(trackingAddressText);
            trackingInfoRow.appendChild(trackingAddress);

            trackingInfo.appendChild(trackingInfoRow);

            modalHeader.appendChild(trackingInfo);


            modalHeader.append()

            // myModal.show();
            $('#exampleModalCenter').modal('show');
        }

    });
}

$(document).ready(function () {
    $.ajax({
        url: 'getTrackInfo.php',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            $('#example').dataTable({
                data: data,
                "autoWidth": false,

                columns: [
                    {data: 'trackNumber'},
                    {data: 'status'},
                    {data: 'dateRegistered'},
                    {data: 'dateUpdated'},
                ],
            })
        }
    });
});

$('#example').on('click', 'tbody tr', function () {
    const trackNumber = $(this).find('td:first').text();
    showModal(trackNumber);
});