document.getElementById("name").addEventListener("change", function() {
    var selectedMember = this.value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var tasks = JSON.parse(this.responseText);
            var options = "";
            tasks.forEach(function(task) {
                options += "<option value='" + task.tname + "'>" + task.tname + "</option>";
            });
            document.getElementById("tname").innerHTML = options;
        }
    };
    xhttp.open("GET", "fetch_tasks.php?member=" + selectedMember, true);
    xhttp.send();
});
