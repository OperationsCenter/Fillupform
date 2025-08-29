<?php
class AccidentReportDB {
    private $host = 'localhost';
    private $db   = 'accident_reports';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
    }

    public function saveReport($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO reports (
                accident_type, manufacturer, model, registration, callsign,
                owner_operator, contact_person, contact_info,
                pic, pic_nationality, total_crew, crew_fatalities,
                others, others_fatalities, others_injured,
                accident_date, accident_time, departure, destination,
                phase_of_flight, visibility, wind, aircraft_position,
                description, dangerous_goods
            ) VALUES (
                :accident_type, :manufacturer, :model, :registration, :callsign,
                :owner_operator, :contact_person, :contact_info,
                :pic, :pic_nationality, :total_crew, :crew_fatalities,
                :others, :others_fatalities, :others_injured,
                :accident_date, :accident_time, :departure, :destination,
                :phase_of_flight, :visibility, :wind, :aircraft_position,
                :description, :dangerous_goods
            )
        ");
        return $stmt->execute([
            ':accident_type'    => $data['accident_type'] ?? '',
            ':manufacturer'     => $data['manufacturer'] ?? '',
            ':model'            => $data['model'] ?? '',
            ':registration'     => $data['registration'] ?? '',
            ':callsign'         => $data['callsign'] ?? '',
            ':owner_operator'   => $data['owner_operator'] ?? '',
            ':contact_person'   => $data['contact_person'] ?? '',
            ':contact_info'     => $data['contact_info'] ?? '',
            ':pic'              => $data['pic'] ?? '',
            ':pic_nationality'  => $data['pic_nationality'] ?? '',
            ':total_crew'       => $data['total_crew'] ?? '',
            ':crew_fatalities'  => $data['crew_fatalities'] ?? '',
            ':others'           => $data['others'] ?? '',
            ':others_fatalities'=> $data['others_fatalities'] ?? '',
            ':others_injured'   => $data['others_injured'] ?? '',
            ':accident_date'    => $data['accident_date'] ?? '',
            ':accident_time'    => $data['accident_time'] ?? '',
            ':departure'        => $data['departure'] ?? '',
            ':destination'      => $data['destination'] ?? '',
            ':phase_of_flight'  => $data['phase_of_flight'] ?? '',
            ':visibility'       => $data['visibility'] ?? '',
            ':wind'             => $data['wind'] ?? '',
            ':aircraft_position'=> $data['aircraft_position'] ?? '',
            ':description'      => $data['description'] ?? '',
            ':dangerous_goods'  => $data['dangerous_goods'] ?? ''
        ]);
    }
}
?>
<?php
require 'form.php';
$db = new AccidentReportDB();

// Result message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new AccidentReportDB();
    if ($db->saveReport($_POST)) {
        $modalTitle = "Success";
        $modalBody = "✔️ Report submitted successfully.";
    } else {
        $modalTitle = "Error";
        $modalBody = "❌ Something went wrong. Please try again later.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Submission</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="resultModalLabel"><?php echo $modalTitle ?? ''; ?></h5>
          </div>
          <div class="modal-body">
            <?php echo $modalBody ?? ''; ?>
          </div>
          <div class="modal-footer">
            <a href="form.php" class="btn btn-primary">Back to Form</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    window.addEventListener('DOMContentLoaded', function() {
        var resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
        resultModal.show();
    });
    </script>
</body>
</html>
