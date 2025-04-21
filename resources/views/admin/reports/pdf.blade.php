<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>School Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .section {
            margin-bottom: 30px;
        }
        h1 {
            color: #4260a6;
            font-size: 24px;
        }
        h2 {
            color: #4260a6;
            font-size: 18px;
            margin-top: 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .demographics-container {
            display: flex;
            justify-content: space-between;
        }
        .demographics-box {
            width: 48%;
        }
        .performance-rating-high {
            color: #28a745;
        }
        .performance-rating-medium {
            color: #ffc107;
        }
        .performance-rating-low {
            color: #dc3545;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $data['school_name'] }} - School Report</h1>
        <p>Generated on: {{ $data['generated_at'] }}</p>
    </div>
    
    <div class="section">
        <h2>Demographics Overview</h2>
        <div class="demographics-container">
            <div class="demographics-box">
                <h3>Students</h3>
                <table>
                    <tr>
                        <th>Gender</th>
                        <th>Count</th>
                        <th>Percentage</th>
                    </tr>
                    <tr>
                        <td>Male</td>
                        <td>{{ $data['demographics']['students']['male'] }}</td>
                        <td>{{ round(($data['demographics']['students']['male'] / $data['demographics']['students']['total']) * 100, 1) }}%</td>
                    </tr>
                    <tr>
                        <td>Female</td>
                        <td>{{ $data['demographics']['students']['female'] }}</td>
                        <td>{{ round(($data['demographics']['students']['female'] / $data['demographics']['students']['total']) * 100, 1) }}%</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>{{ $data['demographics']['students']['total'] }}</strong></td>
                        <td><strong>100%</strong></td>
                    </tr>
                </table>
            </div>
            
            <div class="demographics-box">
                <h3>Staff</h3>
                <table>
                    <tr>
                        <th>Gender</th>
                        <th>Count</th>
                        <th>Percentage</th>
                    </tr>
                    <tr>
                        <td>Male</td>
                        <td>{{ $data['demographics']['staff']['male'] }}</td>
                        <td>{{ round(($data['demographics']['staff']['male'] / $data['demographics']['staff']['total']) * 100, 1) }}%</td>
                    </tr>
                    <tr>
                        <td>Female</td>
                        <td>{{ $data['demographics']['staff']['female'] }}</td>
                        <td>{{ round(($data['demographics']['staff']['female'] / $data['demographics']['staff']['total']) * 100, 1) }}%</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>{{ $data['demographics']['staff']['total'] }}</strong></td>
                        <td><strong>100%</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="section">
        <h2>Weekly Attendance Overview</h2>
        <table>
            <tr>
                <th>Day</th>
                <th>Date</th>
                <th>Present (%)</th>
                <th>Absent (%)</th>
            </tr>
            @foreach($data['attendance'] as $day => $values)
                <tr>
                    <td>{{ $day }}</td>
                    <td>{{ $values['date'] }}</td>
                    <td>{{ $values['present'] ?? 'N/A' }}%</td>
                    <td>{{ $values['absent'] ?? 'N/A' }}%</td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <div class="section">
        <h2>Academic Performance Overview</h2>
        @foreach($data['performance'] as $subject)
            <h3>{{ $subject['name'] }}</h3>
            <table>
                <tr>
                    <th>Grade</th>
                    @php
                        $classroomNames = [];
                        foreach($subject['grades'] as $grade => $classrooms) {
                            foreach($classrooms as $className => $score) {
                                if(!in_array($className, $classroomNames)) {
                                    $classroomNames[] = $className;
                                }
                            }
                        }
                        sort($classroomNames);
                    @endphp
                    
                    @foreach($classroomNames as $className)
                        <th>{{ $className }}</th>
                    @endforeach
                </tr>
                
                @foreach($subject['grades'] as $grade => $classrooms)
                    <tr>
                        <td><strong>Grade {{ $grade }}</strong></td>
                        
                        @foreach($classroomNames as $className)
                            @php
                                $score = $classrooms[$className] ?? 'N/A';
                                $class = '';
                                if(is_numeric($score)) {
                                    if($score >= 80) {
                                        $class = 'performance-rating-high';
                                    } elseif($score >= 70) {
                                        $class = 'performance-rating-medium';
                                    } else {
                                        $class = 'performance-rating-low';
                                    }
                                }
                            @endphp
                            <td class="{{ $class }}">{{ $score }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        @endforeach
        
        <div style="margin-top: 10px;">
            <p><span class="performance-rating-high">■</span> High (80-100) &nbsp;
                <span class="performance-rating-medium">■</span> Medium (70-79) &nbsp;
                <span class="performance-rating-low">■</span> Low (Below 70)</p>
        </div>
    </div>
    
    <div class="footer">
        <p>This report is automatically generated by {{ $data['school_name'] }} Management System.</p>
    </div>
</body>
</html>