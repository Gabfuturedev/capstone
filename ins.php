<?php 
include 'conn.php';
include 'modal.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

/* Container styles */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    margin-top: 20px;
}

/* Heading styles */
h1 {
    color: #333;
    text-align: center;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Table header styles */
table th {
    background-color: #f2f2f2;
}

/* Table row hover effect */
table tr:hover {
    background-color: #f9f9f9;
}

/* CSS for Approved status */
.status-approved {
            color: green;
        }

        /* CSS for Pending status */
.status-pending {
            color: #FFC94A;
        }
.status-rejected {
            color: red;
}
        
        .ellipsis {
    cursor: pointer;
    font-size: 200%;
    text-decoration: none;
    display: inline-block;
    position: relative;
    text-align: center;
    width: 1em; /* Adjust as needed */
    height: 1em; /* Adjust as needed */
    line-height: 1em; /* Adjust as needed */
}

.ellipsis:hover::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 150%; /* Adjust as needed */
    height: 150%; /* Adjust as needed */
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.1); /* Adjust the color and transparency as needed */
}
        /* CSS for options */
        .options {
    display: none;
    position: absolute;
    background-color: #EEEEEE; /* Background color */
    min-width: 120px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    border-radius: 5px; /* Rounded corners */
    color: #FFFFFF; /* White text color */
}

.options button {
    color: #FFFFFF; /* White text color */
    border: none;
    padding: 8px 12px;
    margin: 4px;
    border-radius: 3px; /* Rounded corners */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition on hover */
    display: block; /* Ensure buttons are displayed as block elements */
    width: 100%; /* Full width */
}

.options button.approve {
    background-color: #90D26D; /* Green button background color */
}

.options button.reject {
    background-color: #A34343; /* Red button background color */
}
.modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }/* Style for the image modal */




</style>
<body>
    
<div class="container">
        <h1>Application List</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
             $sql = "SELECT id, firstName, lastName, email, conNum, date, status FROM contbl";
             $result = $conn->query($sql);
             
        

//end of file paths checking

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    echo "<tr onclick=\"openModal('$id')\">"; // Call openModal function on row click
                    echo "<td>" . $row["firstName"] . " " . $row["lastName"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["conNum"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";

                    // Set default status as Pending
                    $status = "Pending";

                    // If status is Approved or Rejected, update $status accordingly
                    if ($row["status"] == 1) {
                        $status = "Approved";
                    } elseif ($row["status"] == 2) {
                        $status = "Rejected";
                    }

                    // Apply status class based on status
                    $statusClass = ($row["status"] == 1) ? "status-approved" : (($row["status"] == 2) ? "status-rejected" : "status-pending");

                    // Display status in table cell
                    echo "<td class='$statusClass'>$status</td>";

                    echo "<td>";
                    // Show options if status is Pending
                    if ($row["status"] == 0) {
                        echo "<span class='ellipsis' data-id='" . $row["id"] . "'><i class='bx bx-dots-horizontal-rounded' aria-hidden='true'></i></span>";

                        echo "<div class='options' id='options_" . $row["id"] . "'>";
                        echo "<button class='approve' data-id='" . $row["id"] . "' onclick='handleStatusUpdate(event, 1)'>Approve</button>";
                        echo "<button class='reject' data-id='" . $row["id"] . "' onclick='handleStatusUpdate(event, 2)'>Reject</button>";
                        
                        echo "</div>";
                    }
                    echo "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
    
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalData"> <!-- This div will hold the fetched data -->
            <!-- Content will be inserted here -->
        </div>
    </div>

    <div id="imageModal" class="modal" style="justify-content: center;" >
    <span class="close" onclick="closeImageModal()">&times;</span>
    <img id="modalImage" src="" alt="Full View" style="max-width: 100%; height: auto;">
</div>

</div>
<!-- Image Zoom Modal -->



<script>
   document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.ellipsis').forEach(function(ellipsis) {
        ellipsis.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop propagation to the parent <tr>
            const optionsId = 'options_' + this.getAttribute('data-id');
            toggleOptions(optionsId);
        });
    });
});
function handleStatusUpdate(event, status) {
    // Prevent the event from propagating to the parent elements (e.g., row click event)
    event.stopPropagation();
    
    // Get the ID from the data-id attribute of the button
    const id = event.target.getAttribute('data-id');
    
    // Call the function to update the application status
    updateApplicationStatus(id, status);
}


// Centralized AJAX function to update the application status
function updateApplicationStatus(id, status) {
    $.ajax({
        url: 'update_status.php',
        type: 'POST',
        data: { id: id, status: status },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Application status updated successfully.');
                location.reload(); // Refresh the page to reflect changes
            } else {
                alert('Error updating status: ' + response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
            alert('An error occurred: ' + error);
        }
    });
}

// Centralized AJAX function
function sendAjaxRequest(url, data, successCallback, errorCallback) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: successCallback,
        error: errorCallback
    });
}

// Handle updating application status
function updateApplicationStatus(id, status) {
    console.log("Updating status for ID:", id, "to", status);
    $.ajax({
        url: 'update_status.php',
        type: 'POST',
        data: { id: id, status: status },
        dataType: 'json',
        success: function(response) {
            console.log("Server response:", response);
            if (response.success) {
                alert('Application status updated successfully.');
                location.reload(); // Refresh the page to reflect changes
            } else {
                alert('Error updating status: ' + response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request error:', error);
            alert('An error occurred: ' + error);
        }
    });
}


// Add event listeners for buttons using event delegation
document.addEventListener('click', function(event) {
    if (event.target.id === 'acceptButton') {
        // Accept button clicked
        const dataId = event.target.dataset.id;
        updateApplicationStatus(dataId, 1);
        closeModal(); // Close the modal
    } else if (event.target.id === 'rejectButton') {
        // Reject button clicked
        const dataId = event.target.dataset.id;
        updateApplicationStatus(dataId, 2);
        closeModal(); // Close the modal
    }
});

// Function to open the main modal and fetch application data
function openModal(id) {
    // Open modal logic
    var mainModal = document.getElementById("myModal");
    mainModal.style.display = "block";

    // Fetch application data
    sendAjaxRequest('fetch_application_data.php', { id: id }, function(response) {
        if (response.success) {
            populateModalData(response.data);
        } else {
            displayErrorInModal(response.error);
        }
    }, function(xhr, status, error) {
        displayErrorInModal('An error occurred while fetching data.');
    });
}

// Function to populate modal data
function populateModalData(data) {
    var modalData = document.getElementById('modalData');
    modalData.innerHTML = `
        <p>Name: ${data.firstName} ${data.lastName}</p>
        <p>Email: ${data.email}</p>
        <p>Contact Number: ${data.conNum}</p>
        <p>Date: ${data.date}</p>
        <p>Status: ${data.status}</p>
        <!-- Application Letter, CV, Picture, Validation ID -->
        <p>Application Letter:</p>
        <img src="${data.appLetter}" alt="Application Letter" class="clickable-img" style="max-width: 50%; height: auto;">
        <p>CV:</p>
        <img src="${data.cv}" alt="CV" class="clickable-img" style="max-width: 50%; height: auto;">
        <p>Picture:</p>
        <img src="${data.picture}" alt="Picture" class="clickable-img" style="max-width: 50%; height: auto;">
        <p>Validation ID:</p>
        <img src="${data.valId}" alt="Validation ID" class="clickable-img" style="max-width: 50%; height: auto;">
        <!-- Action buttons -->
      
    `;

    // Add click event listeners to images for zooming
    addImageClickListeners();
}


// Add image click listeners
function addImageClickListeners() {
    document.querySelectorAll('.clickable-img').forEach(img => {
        img.addEventListener('click', function() {
            openImageModal(this.src);
        });
    });
}

// Function to open the image modal
function openImageModal(imageSrc) {
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    // Set the image source
    modalImage.src = imageSrc;

    // Center the image by adjusting the styles
    modalImage.style.display = 'block';
    modalImage.style.maxWidth = '100%'; // Adjust as necessary
    modalImage.style.maxHeight = '100%'; // Adjust as necessary
    modalImage.style.objectFit = 'contain'; // Ensures the image stays within modal bounds

    // Show the modal
    imageModal.style.display = 'flex';
    imageModal.style.justifyContent = 'center';
    imageModal.style.alignItems = 'center';
    imageModal.style.backdropFilter = 'blur(5px)';
    imageModal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';

    // Add event listener to close modal when clicking outside the modal image
    imageModal.addEventListener('click', handleOutsideClick);
}

// Function to handle clicks outside the modal image
function handleOutsideClick(event) {
    const modalImage = document.getElementById('modalImage');
    const imageModal = document.getElementById('imageModal');

    // Check if the clicked element is not the modal image
    if (event.target !== modalImage) {
        closeImageModal();
    }
}

// Function to close the image modal
function closeImageModal() {
    const imageModal = document.getElementById('imageModal');
    imageModal.style.display = 'none';

    // Remove the event listener to prevent duplicate listeners
    imageModal.removeEventListener('click', handleOutsideClick);
}

// Function to close the main modal
function closeModal() {
    var mainModal = document.getElementById("myModal");
    mainModal.style.display = "none";
}

// Display error in modal
function displayErrorInModal(errorMessage) {
    var modalData = document.getElementById('modalData');
    modalData.innerHTML = `<p>Error: ${errorMessage}</p>`;
}

// Toggle options for the ellipsis menu
function toggleOptions(id) {
    var options = document.getElementById(id);
    var allOptions = document.querySelectorAll('.options');
    
    // Close all options boxes
    allOptions.forEach(option => {
        if (option.id !== id) {
            option.style.display = 'none';
        }
    });

    // Toggle the selected options box
    options.style.display = (options.style.display === 'none' || options.style.display === '') ? 'block' : 'none';
}
</script>


    </script>
    
</body>
</html>