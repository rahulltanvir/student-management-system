<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 <script>
// 🔴 DELETE CONFIRM
function confirmDelete(event, url){
    event.preventDefault();

    swal({
        title: "Are you sure?",
        text: "You want to delete this section!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = url;
        }
    });
}
</script>
<?php if (isset($_SESSION['success'])) { ?>
<script>
let type = "<?= $_SESSION['type'] ?? 'success' ?>";

let title = "Success!";
let icon = "success";

if (type === "delete") {
    title = "Deleted!";
    icon = "warning";
} else if (type === "error") {
    title = "Error!";
    icon = "error";
}

swal({
    title: title,
    text: "<?= $_SESSION['success']; ?>",
    icon: icon,
    button: "OK",
}).then(() => {
    window.location = "section.php";
});
</script>

<?php
unset($_SESSION['success']);
unset($_SESSION['type']);
} ?>  