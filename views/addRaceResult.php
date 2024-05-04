<?php $title = 'Add Race Result'; ?>
<?php include 'views/layoutHeader.php'; ?>

<h2 class="mt-4">Add New Race Result</h2>
<form class="mt-4" method="post" action="addresultform">
    <input type="hidden" id="race_id" name="race_id" value="<?= $raceId ?>">
    <div class="mb-3">
        <label for="num_swimmers" class="form-label">Number of Swimmers:</label>
        <input type="number" class="form-control" id="num_swimmers" name="num_swimmers" min="1" required>
    </div>

    <div class="mb-3">
        <label for="participants" class="form-label">Participants:</label>
        <table class="table table-bordered" id="participants_table">
            <thead>
                <tr>
                    <th>Participant Membership ID</th>
                    <th>Time Taken</th>
                    <th>Place</th>
                </tr>
            </thead>
            <tbody id="participants_body">
                <!-- Participants will be generated here -->
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
document.getElementById("num_swimmers").addEventListener("input", generateParticipants);

function generateParticipants() {
    var numSwimmers = parseInt(document.getElementById("num_swimmers").value);
    var tableBody = document.getElementById("participants_body");
    tableBody.innerHTML = ""; // Clear previous content

    for (var i = 0; i < numSwimmers; i++) {
        var row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="number" class="form-control" min="0" name="participant_id[]" required></td>
            <td>
                <div class="row">
                    <div class="col d-flex gap-3 align-items-center">
                        <input type="number" class="form-control" name="participant_hours[]" min="0" max="99" value="00" required>
                        <label class="form-label mb-0">Hours</label>
                    </div>
                    <div class="col d-flex gap-3 align-items-center">
                        <input type="number" class="form-control" name="participant_minutes[]" min="0" max="59" value="00" required>
                        <label class="form-label mb-0">Minutes</label>
                    </div>
                    <div class="col d-flex gap-3 align-items-center">
                        <input type="number" class="form-control" name="participant_seconds[]" min="0" max="59" value="00" required>
                        <label class="form-label mb-0">Seconds</label>
                    </div>
                 </div>
            </td>
            <td class="align-middle text-center"><input type="text" class="form-control" name="place[]" value="${i + 1}"></td>
        `;
        tableBody.appendChild(row);
    }
}
</script>

<?php include 'views/layoutFooter.php'; ?>