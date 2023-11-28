function updateDonor(donorId) {
  // Implement your logic for updating a donor
  console.log('Update donor with ID: ' + donorId);
}

function deleteDonor(donorId) {
  // Implement your logic for deleting a donor
  console.log('Delete donor with ID: ' + donorId);
}

function acceptRequest(requestId) {
  // AJAX request to accept blood request
  $.ajax({
      url: 'accept_request.php',
      type: 'POST',
      data: { requestId: requestId },
      success: function (response) {
          // Handle success, you can display the response or perform further actions
          console.log(response);
      },
      error: function (error) {
          // Handle error, if needed
          console.error("Error accepting blood request", error);
      }
  });
}

function rejectRequest(requestId) {
  // AJAX request to reject blood request
  $.ajax({
      url: 'reject_request.php',
      type: 'POST',
      data: { requestId: requestId },
      success: function (response) {
          // Handle success, you can display the response or perform further actions
          console.log(response);
      },
      error: function (error) {
          // Handle error, if needed
          console.error("Error rejecting blood request", error);
      }
  });
}

function editRequest(requestId) {
  // Implement your logic for editing a request
  console.log('Edit request with ID: ' + requestId);
}

function deleteRequest(requestId) {
  // Implement your logic for deleting a request
  console.log('Delete request with ID: ' + requestId);
}