<?php
require('../fpdf/fpdf.php');

// Datos de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos
$sql = "SELECT * FROM respuestas";
$result = $conn->query($sql);

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Encuesta', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function PieChart($w, $h, $data, $title)
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode($title), 0, 1, 'C');

        $total = array_sum($data);
        if ($total == 0) {
            $this->Cell(0, 10, 'No hay datos para mostrar', 0, 1, 'C');
            return;
        }

        $angle_start = 0;
        $cx = $this->GetX() + $w / 2;
        $cy = $this->GetY() + $h / 2;
        $r = min($w, $h) / 2;

        foreach ($data as $label => $value) {
            if ($value > 0) {
                $angle = ($value / $total) * 360;
                if ($angle == 0) continue; // Evitar sectores con ángulos de 0
                $angle_end = $angle_start + $angle;
                if ($angle_start == $angle_end) continue; // Evitar sectores con ángulos de 0
                $this->SetFillColor(rand(0, 255), rand(0, 255), rand(0, 255));
                $this->Sector($cx, $cy, $r, $angle_start, $angle_end);
                $percentage = round(($value / $total) * 100, 2) . '%'; // Calcular el porcentaje
                $mid_angle_rad = deg2rad($angle_start + $angle / 2);
                $tx = $cx + ($r * cos($mid_angle_rad)) * 0.7;
                $ty = $cy + ($r * sin($mid_angle_rad)) * 0.7;
                $this->SetXY($tx - 10, $ty - 5);
                $this->Cell(20, 10, utf8_decode("$label ($percentage)"), 0, 0, 'C'); // Mostrar la etiqueta y el porcentaje
                $angle_start += $angle;
            }
        }
        $this->SetXY($this->GetX(), $this->GetY() + $r * 2 + 10);
    }

    function Sector($xc, $yc, $r, $a, $b)
    {
        // Verificar que $r no sea cero y que $a y $b no sean iguales para evitar la división por cero
        if ($r == 0 || $a == $b) {
            return;
        }

        $a = ($a % 360) + 90;
        $b = ($b % 360) + 90;
        if ($a > $b) {
            $b += 360;
        }
        $b = deg2rad($b);
        $a = deg2rad($a);
        $x = $xc + $r * cos($a);
        $y = $yc + $r * sin($a);
        $this->_Point($xc, $yc);
        $this->_Point($x, $y);
        $angle = $b - $a;
        if ($angle == 0) return; // Evitar ángulos de 0
        $n = ceil($angle / M_PI_2);
        $angle = $angle / $n;
        for ($i = 0; $i < $n; $i++) {
            $a += $angle;
            $x = $xc + $r * cos($a);
            $y = $yc + $r * sin($a);
            $this->_Curve($x, $y, $xc, $yc);
        }
        $this->_Point($xc, $yc);
        $this->_Out('f');
    }

    function _Curve($x1, $y1, $x2, $y2)
    {
        $this->_Out(sprintf('%.2F %.2F %.2F %.2F v', $x1 * $this->k, ($this->h - $y1) * $this->k, $x2 * $this->k, ($this->h - $y2) * $this->k));
    }

    function _Point($x, $y)
    {
        $this->_Out(sprintf('%.2F %.2F m', $x * $this->k, ($this->h - $y) * $this->k));
    }
}

$pdf = new PDF();

if ($result->num_rows > 0) {
    $header = ['Campo 1', 'Campo 2', 'Campo 3', 'Campo 4', 'Campo 5', 'Campo 6', 'Campo 7', 'Campo 8', 'Campo 9', 'Campo 10']; // Encabezados para los 10 campos
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [$row['campo1'], $row['campo2'], $row['campo3'], $row['campo4'], $row['campo5'], $row['campo6'], $row['campo7'], $row['campo8'], $row['campo9'], $row['campo10']]; // Datos de los 10 campos
    }

    // Graficar cada campo
    foreach ($header as $campo) {
        $campoIndex = array_search($campo, $header);
        $values = array_column($data, $campoIndex);
        $counts = array_count_values($values);

        $pdf->AddPage();
        $pdf->PieChart(180, 100, $counts, "Gráfico de $campo");
    }
} else {
    $pdf->AddPage(); // Añadir una página para el mensaje de "No se encontraron resultados."
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 0, 1, 'C');
}

// Cerrar conexión
$conn->close();

// Salida del PDF
$pdf->Output();
echo 'PDF generado exitosamente'; // Añadir mensaje de éxito
?>
