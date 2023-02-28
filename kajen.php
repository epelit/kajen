<html>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<?php
//These measurements are hardcoded in but script can be edited to generated programmatically
//Hard coded json and json2 get results (ping and traceroute) from 3 probes based in Philippines to ccTLD ns2.cuhk.edu.hk

    $json=file_get_contents("https://atlas.ripe.net/api/v2/measurements/50251835/results/?format=json"); //data for v4 ping
    $json2=file_get_contents("https://atlas.ripe.net/api/v2/measurements/50243985/results/?format=json"); //data for v4 traceroute
    $data =  json_decode($json);
    $data2 =  json_decode($json2);

//Title Philippines hard coded in but can be generated in later versions
echo "<h1>Philippines</h>";
//write data to html table
echo "<table id=myTable>";
echo "  <tr> ";
echo "    <th onclick='sortTable(0)'>Measurement ID</th>";
echo "    <th onclick='sortTable(1)'>Probe</th>";
echo "    <th onclick='sortTable(2)'>Src Address</th>";
echo "    <th onclick='sortTable(3)'>Dst Address</th>";
echo "    <th onclick='sortTable(4)'>FQDN</th>";
echo "    <th onclick='sortTable(5)'>Hop Count</th>";
echo "    <th onclick='sortTable(6)'>Latency</th>";
echo "  </tr>";


foreach($data as $va)
{		//write data to html table
        echo "<tr>";
        echo "<td>" . $va->msm_id . "</td>";
        echo "<td>" . $va->prb_id . "</td>";
        echo "<td>" . $va->src_addr . "</td>";
        echo "<td>" . $va->dst_addr . "</td>";
        $dst = $va->dst_addr;
        $rr = shell_exec("dig -x " . $dst . " +short");
        echo "<td>" .$rr . "</td>";
        $hopcount=0;
        foreach ($va->result as $vb)
        {
                $hopcount++;
        }
        echo "<td>" . $hopcount . "</td>";
        echo "<td>" ." " . "</td>";

        echo "</tr>";
}

foreach($data2 as $va)
{       //write data to html table
        echo "<tr>";
        echo "<td>" . $va->msm_id . "</td>";
        echo "<td>" . $va->prb_id . "</td>";
        echo "<td>" . $va->src_addr . "</td>";
        echo "<td>" . $va->dst_addr . "</td>";
       $dst = $va->dst_addr;
        $rr = shell_exec("dig -x " . $dst . " +short");
        echo "<td>" .$rr . "</td>";
        echo "<td>" ." " . "</td>";
        echo "<td>" . $va->avg . "</td>";
        echo "</tr>";
}

//These measurements are hardcoded in but script can be edited to generated programmatically
//Hard coded json and json2 get results (ping and traceroute) from 3 probes based in Philippines to ccTLD ns2.cuhk.edu.hk

    $json=file_get_contents("https://atlas.ripe.net/api/v2/measurements/50251861/results/?format=json"); //data for v6 ping
    $json2=file_get_contents("https://atlas.ripe.net/api/v2/measurements/50243986/results/?format=json"); //data for v6 traceroute
    $data =  json_decode($json); //convert json to array
    $data2 =  json_decode($json2);
foreach($data as $va)
{		//write data to html table
        echo "<tr>";
        echo "<td>" . $va->msm_id . "</td>";
        echo "<td>" . $va->prb_id . "</td>";
        echo "<td>" . $va->src_addr . "</td>";
        echo "<td>" . $va->dst_addr . "</td>";
        $dst = $va->dst_addr;
        $rr = shell_exec("dig -x " . $dst . " +short");
        echo "<td>" .$rr . "</td>";
        $hopcount=0;
        foreach ($va->result as $vb)
        {
                $hopcount++;
        }
        echo "<td>" . $hopcount . "</td>";
        echo "<td>" ." " . "</td>";
        echo "</tr>";
}

foreach($data2 as $va)
{		//write data to html table
        echo "<tr>";
        echo "<td>" . $va->msm_id . "</td>";
        echo "<td>" . $va->prb_id . "</td>";
        echo "<td>" . $va->src_addr . "</td>";
        echo "<td>" . $va->dst_addr . "</td>";
       $dst = $va->dst_addr;
        $rr = shell_exec("dig -x " . $dst . " +short");
        echo "<td>" .$rr . "</td>";
        echo "<td>" ." " . "</td>";
        echo "<td>" . $va->avg . "</td>";
        echo "</tr>";
}


echo "</table>";
?>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
</html>


