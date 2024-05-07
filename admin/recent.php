<div class="container h-100">
    <!-- Adjust this value to change the card's width -->
    <div class="card h-80">
        <div class="card-header text-center">
            <h3 class="card-title">Recent Activity</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            $query = $conn->query("
                        SELECT archive_list.title,archive_list.date_created,archive_list.id,student_list.firstname FROM archive_list 
                        LEFT JOIN student_list ON archive_list.student_id = student_list.id WHERE archive_list.date_created >= DATE_SUB(NOW(), INTERVAL 7 DAY) 
                        ORDER BY archive_list.date_created DESC;");
                        $counter = 0;
            while ($row = $query->fetch_assoc()) :
                $date_created = new DateTime($row['date_created']);
                $now = new DateTime();
                $interval = $date_created->diff($now);
                $minutes_ago = $interval->days * 24 * 60;
                $minutes_ago += $interval->h * 60;
                $minutes_ago += $interval->i;
                if ($counter == 5) {
                    break;
                }
                if ($minutes_ago < 60) {
                    if ($minutes_ago <= 0)
                        $time_ago = ' few seconds ago';
                    if ($minutes_ago == 1)
                        $time_ago = $minutes_ago . ' minute ago';
                    else
                        $time_ago = $minutes_ago . ' minutes ago';
                } elseif ($minutes_ago < 24 * 60) {
                    $hours_ago = floor($minutes_ago / 60);
                    if ($hours_ago == 1)
                        $time_ago = $hours_ago . ' hour ago';
                    else
                        $time_ago = $hours_ago . ' hours ago';
                } elseif ($minutes_ago < 24 * 60 * 30) {
                    $days_ago = floor($minutes_ago / (24 * 60));
                    if ($days_ago == 1)
                        $time_ago = $days_ago . ' day ago';
                    else
                        $time_ago = $days_ago . ' days ago';
                } else {
                    $months_ago = floor($minutes_ago / (24 * 60 * 30));
                    if ($months_ago == 1)
                        $time_ago = $months_ago . ' month ago';
                    else
                        $time_ago = $months_ago . ' months ago';
                }
            ?>
            <div class="card w-100 ">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="info-box-icon bg-success px-2 py-1 rounded-circle">
                            <span class="fas fa-upload "></span>
                        </div>
                        <div class="col-8">
                            <p class="card-text text-left px-1 py-1" style="font-size: 14px ;"><?php echo $row['firstname'] . " submitted an archive"; ?></p>
                        </div>
                        <div class="col-3 d-flex justify-content-start">
                            <p class="card-text px-2 py-2 text-right text-muted" style="font-size: 10px;"><?php echo $time_ago; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php $counter++; endwhile; ?>
        </div>
        <!-- /.card-body -->
    </div>
</div>