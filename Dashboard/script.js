function addUser() {
    let stud_id = $("#stud_id").val();
    let fname = $("#fname").val();
    let lname = $("#lname").val();
    let email = $("#email").val();
    let age = $("#age").val();
    let address = $("#address").val();

    if (stud_id !== '' && fname !== '') {
        let newRow = $("<tr></tr>");

        newRow.append(`
            <td>${stud_id}</td>
            <td>${fname}</td>
            <td>${lname}</td>
            <td>${email}</td>
            <td>${age}</td>
            <td>${address}</td>
            <td>
                <button class="btn btn-warning"><figure><img src="../images/edit.svg" alt="edit-icon"></figure></button>
                <button class="btn btn-danger" type="button" value="Delete"><figure><img src="../images/delete.svg" alt="delete-icon"></figure></button>
            </td>
        `);

        $("#userTableBody").append(newRow);
        $("#liveAlert").html('<div class="alert alert-success" role="alert">Data has been added.</div>');
        reset();
    } else {
        $("#liveAlert").html('<div class="alert alert-danger" role="alert">Please fill in the required data.</div>');
    }
}


function deleteUser() {
    var confirmation = confirm("Are you sure to delete this data?");
    if (confirmation) {
        $(this).closest("tr").remove();
        $("#liveAlert").html('<div class="alert alert-success" role="alert">Data has been deleted.</div>');
        reset();
    }
}

function reset(){
    $("#stud_id").val("");
    $("#fname").val("");
    $("#lname").val("");
    $("#email").val("");
    $("#age").val("");
    $("#address").val("");
}

function editUser() {
    rowToUpdate = $(this).closest("tr");
    let tds = rowToUpdate.find("td");

    $("#stud_id").val(tds.eq(0).text()).prop("readonly", true);
    $("#fname").val(tds.eq(1).text());
    $("#lname").val(tds.eq(2).text());
    $("#email").val(tds.eq(3).text());
    $("#age").val(tds.eq(4).text());
    $("#address").val(tds.eq(5).text());

    $("#addUserBtn").hide();
    $("#updateUserBtn").show().css("width", "100%");
}

function updateUser() {
    if (stud_id ==='' || fname==='')  {
        $("#liveAlert").html('<div class="alert alert-danger" role="alert">There is an error.</div>');
    } else {
        let stud_id = $("#stud_id").val();
        let fname = $("#fname").val();
        let lname = $("#lname").val();
        let email = $("#email").val();
        let age = $("#age").val();
        let address = $("#address").val();
        // Find the row to update based on the values in the input fields
        let row = $("#userTableBody").find(`tr:contains(${stud_id})`);

        // Update the row with new values
        row.find("td:eq(1)").text(fname);
        row.find("td:eq(2)").text(lname);
        row.find("td:eq(3)").text(email);
        row.find("td:eq(4)").text(age);
        row.find("td:eq(5)").text(address);
        // Display success message
        $("#liveAlert").html('<div class="alert alert-success" role="alert">Data has been updated.</div>');
        $("#updateUserBtn").hide();
        $("#addUserBtn").show();
    }

}  

$(document).ready(function() {
    $(document).on("click", ".btn-danger", deleteUser);
    $(document).on("click", ".btn-warning", editUser);
    $("#updateUserBtn").on("click", updateUser);

    $("#search").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#userTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
