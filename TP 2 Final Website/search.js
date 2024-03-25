function searchPerfumes() {
    var query = $('#searchQuery').val();
    if (query.length < 1) {
        $('#searchResults').html('');
        return;
    }
    
    $.ajax({
        url: 'search_perfumes.php',
        type: 'GET',
        data: { query: query }, // Make sure this matches with your PHP script expecting a `query` parameter
        dataType: 'json',
        success: function(data) {
            var html = '';
            $.each(data, function(index, perfume) {
                html += `<div class="search-item" onclick="showPerfumeDetails(${perfume.productID})">
                            <img src="${perfume.images}" alt="${perfume.name}" class="search-item-img">
                            <span>${perfume.name}</span>
                        </div>`;
            });
            $('#searchResults').html(html);
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}


function showPerfumeDetails(productId) {
    $.ajax({
        url: 'get_perfume_details.php?productID=' + productId,
        type: 'GET',
        data: {productID: productId},
        dataType: 'json',
        success: function(data) {
            var perfume = data[0]; // Assuming the script returns an array with one object
            var html = `<div class="perfume-details">
                            <img src="${perfume.images}" alt="${perfume.name}" class="perfume-details-img">
                            <h2>${perfume.name}</h2>
                            <p>${perfume.description}</p>
                            <p>Price: £${perfume.price}</p>
                            <button onclick="addToCart(${perfume.productID}, 1)">Add to Cart</button>
                        </div>`;

                        // Inside showPerfumeDetails function, after setting HTML content:
                        showModal();

            // Assuming you have a modal or an element to display this
            $('#perfumeDetailModal .modal-content').html(html);
            $('#perfumeDetailModal').show(); // Adjust this to match how you show modals
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

// Implement addToCart function if not already available
function addToCart(productId, quantity) {
    $.ajax({
        url: 'add_to_cart.php',
        type: 'POST',
        data: { productID: productId, quantity: quantity },
        success: function(response) {
            var data = JSON.parse(response);
            if(data.status === 'success') {
                alert(data.message);
                // Optional: Update cart icon count or refresh page
            } else {
                alert(data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}


// Show the modal with perfume details
function showModal() {
    $('#perfumeDetailModal').show();
}

// Hide the modal when clicked outside of the modal content
$(window).on('click', function(event) {
    var modal = $('#perfumeDetailModal');
    if ($(event.target).is(modal)) {
        modal.hide();
    }
});

