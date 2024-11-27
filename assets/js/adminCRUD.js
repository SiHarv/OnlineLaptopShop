$(document).ready(function () {

    // Load images
    const loadImage = () => {
        $.ajax({
            url: "../../backend/adminFUNCTIONS/selectIMAGE.php",
            type: "GET",
            success: (data) => {
                $("#image-data").html(data);
            },
            error: (xhr, status, error) => {
                console.error("AJAX Error: ", status, error);
                alert("Something went wrong: " + error);
            }
        })
    }
    setTimeout(() => {
        loadImage();
    }, 1000);

    const count = () => {
        $.ajax({
            url: "../../backend/adminFUNCTIONS/totalCOUNT.php",
            type: "GET",
            success: (data) => {
                $("#count").html(data);
            },
            error: (xhr, status, error) => {
                console.error("AJAX Error: ", status, error);
                alert("Something went wrong: " + error);
            }
        })
    }
    setTimeout(() => {
        count();
    }, 1000);

    // Save image in database
    $("#save").on("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: "../../backend/adminFUNCTIONS/insertIMAGE.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                if (data == 1) {
                    alert("Image added successfully");
                    $("#addImage").modal("hide");
                    $("#save").trigger("reset");
                    loadImage();
                    count();
                } else if (data == 2) {
                    alert("File is too large");
                } else if (data == 3) {
                    alert("Invalid image extension");
                } else {
                    alert("Something went wrong");
                }
            },
            error: (xhr, status, error) => {
                console.error("AJAX Error: ", status, error);
                alert("Something went wrong: " + error);
            }
        })
    });

    $(document).on("click", '#edit-images', function () {
        const id = $(this).data("id");
        $.ajax({
            url: "../../backend/adminFUNCTIONS/editIMAGE.php",
            type: "POST",
            data: { product_id: id },
            success: (data) => {
                $("#edit-image").html(data);
                $("#updateImage").modal("show");
            },
            error: (xhr, status, error) => {
                console.error("AJAX Error: ", status, error);
                alert("Something went wrong: " + error);
            }
        })
    });

    $("#update").on("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: "../../backend/adminFUNCTIONS/updateIMAGE.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                if (data == 1) {
                    alert("Image updated successfully");
                    $("#updateImage").modal("hide");
                    $("#update").trigger("reset");
                    loadImage();
                    count();
                } else if (data == 2) {
                    alert("File is too large");
                } else if (data == 3) {
                    alert("Invalid image extension");
                } else {
                    alert("Something went wrong");
                }
            },
            error: (xhr, status, error) => {
                console.error("AJAX Error: ", status, error);
                alert("Something went wrong: " + error);
            }
        })
    });

    // Delete handlers
    $(document).on("click", "#delete-image", function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        $("#delete_id").val(id);
        $("#deleteConfirmModal").modal("show");
    });

    $(document).on("click", "#confirmDelete", function() {
        const id = $("#delete_id").val();
        $.ajax({
            url: "../../backend/adminFUNCTIONS/deleteIMAGE.php",
            type: "POST",
            data: { id: id },
            success: function(data) {
                if(data == 1) {
                    $("#deleteConfirmModal").modal("hide");
                    alert("Deleted successfully");
                    loadImage();
                    count();
                } else {
                    alert("Something went wrong");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                alert("Something went wrong: " + error);
            }
        });
    });

    // Search functionality
    $("#search").on("keyup", function() {
        const query = $(this).val();
        $.ajax({
            url: "../../backend/adminFUNCTIONS/searchIMAGE.php",
            type: "GET",
            data: { query: query },
            success: function(data) {
                $("#image-data").html(data);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                alert("Something went wrong: " + error);
            }
        });
    });
});