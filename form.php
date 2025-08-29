<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accident / Incident Report Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .header-logo {
            width: 100%;
            height: auto;
            display: block;
            margin: 0;
            padding: 0;
            object-fit: cover;
        }


        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px 5%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        center {
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        label {
            font-weight: bold;
        }

        .section {
            margin-top: 20px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

            .checkbox-group label {
                font-weight: normal;
            }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .two-column {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

            .two-column > div {
                flex: 1 1 48%;
            }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

            button[type="submit"]:hover {
                background-color: #0056b3;
            }

        @media (max-width: 600px) {
            .two-column {
                flex-direction: column;
            }

                .two-column > div {
                    flex: 1 1 100%;
                }

            h2 {
                font-size: 1.5rem;
            }
        }
           .reminders-box {
        background: #f8f9fa;
        border-left: 5px solid #007bff;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-size: 14px;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    .reminders-box b {
        display: block;
        margin-bottom: 10px;
        font-size: 16px;
        color: #0056b3;
    }
    details {
        cursor: pointer;
    }
    </style>
</head>
<body>


    <div class="container" id="formContent">
        <img src="Images/HeaderLogo.png" alt="Header Logo" class="header-logo">
        <center>CAAP OPERATIONS CENTER DIVISION</center>
        <h2>Initial Accident / Incident Report Form</h2>
        <center>USE ALL CAPS ON SUBMISSION</center>

        <form action="submit_form.php" method="POST">

            <div class="section">
                <label>1. Identification of Accident / Incident:</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="accident_type" value="ACCID"> ACCID accident</label>
                    <label><input type="checkbox" name="accident_type" value="SINCID"> SINCID serious incident</label>
                    <label><input type="checkbox" name="accident_type" value="INCID"> INCID incident</label>
                </div>
            </div>

            <div class="section">
                <label>2. Aircraft Information:</label>
                <div class="two-column">
                    <div>
                        Manufacturer: <input type="text" name="manufacturer" required>
                        Registration: <input type="text" name="registration" required>
                    </div>
                    <div>
                        Model: <input type="text" name="model" required>
                        Call Sign: <input type="text" name="callsign" required>
                    </div>
                </div>
            </div>

            <div class="section">
                <label>3. Owner / Operator Information:</label>
                Owner/Operator: <input type="text" name="owner_operator" required>
                Contact Person: <input type="text" name="contact_person" required>
                Contact Info: <input type="text" name="contact_info" required>
            </div>

            <div class="section">
                <label>4. Crew Information:</label>
                <div class="two-column">
                    <div>
                        Pilot-in-Command: <input type="text" name="pic" required>
                        Nationality: <input type="text" name="pic_nationality" required>
                        Total Crew: <input type="number" name="total_crew" required>
                        Fatalities Crew: <input type="number" name="crew_fatalities" required>
                        Injured Crew: <input type="number" name="crew_injured" required>
                    </div>
                    <div>
                        First Officer: <input type="text" name="fo" required>
                        Nationality: <input type="text" name="fo_nationality" required>
                        Passengers: <input type="number" name="passengers" required>
                        Fatalities Passengers: <input type="number" name="passenger_fatalities"required>
                        Injured Passengers: <input type="number" name="passenger_injured" required>
                    </div>
                </div>
                Others: <input type="number" name="others" required>
                Fatalities: <input type="number" name="others_fatalities" required>
                Injured: <input type="number" name="others_injured" required>
            </div>

            <div class="section">
                <label>5. Date and Time of Accident / Incident:</label>
                <div class="two-column">
                    <div>Date: <input type="date" name="accident_date" required></div>
                    <div>Time (UTC): <input type="time" name="accident_time" required></div>
                </div>
            </div>

            <div class="section">
                <label>6. Aerodromes:</label>
                <div class="two-column">
                    <div>Departure: <input type="text" name="departure" required></div>
                    <div>Destination: <input type="text" name="destination" required></div>
                </div>
            </div>

            <div class="section">
                <label>7. Phase of Flight:</label>
                <input type="text" name="phase_of_flight" required>
            </div>

            <div class="section">
                <label>8. Weather at Airport:</label>
                <div class="two-column">
                    <div>Visibility: <input type="text" name="visibility" required></div>
                    <div>Wind Dir/Speed: <input type="text" name="wind" required></div>
                </div>
            </div>

            <div class="section">
                <label>9. Aircraft Position (Lat / Long):</label>
                <input type="text" name="aircraft_position" required>
            </div>

            <div class="section">
                <label>10. Description of Accident / Incident:</label>
                <textarea name="description" required></textarea>
            </div>

            <div class="section">
                <label>11. Dangerous Goods Onboard:</label>
                <textarea name="dangerous_goods" required></textarea>
            </div>

            <div class="section">
                <label>12. Report by:</label>
                <p>
                    <div class="two-column">
                        <div>Complete Name: <input type="text" name="CompleteName" required></div>
                        <div>Position/Designation: <input type="text" name="Position" required></div>
                        <div>Company/Agency: <input type="text" name="Company" required></div>
                        <div>Office/Dept/Section: <input type="text" name="Office" required></div>
                    </div>
            </div>
            
            <button type="submit">Submit</button>
            <!-- Download button for PDF-->
            <button type="button" onclick="generatePDF()">Download PDF</button>
        </form>
    </div>
</div>

    <!--PDF GENERATOR SCRIPT-->
    <script src="js/html2pdf.bundle.min.js"></script>
<script>
    function generatePDF() {
        const element = document.querySelector('.container'); // or your form/container
        html2pdf().from(element).save('Accident_Incident_Report.pdf');
    }
</script>

<div class="reminders-box">
    <details>
        <summary><b>REMINDERS IN FILLING OUT THE INITIAL AIRCRAFT ACCIDENT / INCIDENT REPORT FORM</b> (Click to expand)</summary>
        <p><b>Item # 1:</b> Check ACCID (accident) if the occurrence is associated with the operation of an aircraft that results in death, serious injury, or substantial damage to the aircraft. This definition typically covers events from the time a person boards with the intention of flight until they have disembarked.<br>
        Check SINCID (serious incident) if the event is associated with the operation of an aircraft that indicates a high probability of an accident.<br>
        Check INCID (incident) if the occurrence compromises safety but does not result in an accident.</p>

        <p><b>Item # 2:</b> Call sign – must be the same as filed in flight plan.</p>
        <p><b>Item # 3:</b> Contact person – preferably the one involved in attending to the accident / incident.</p>
        <p><b>Item # 4:</b> “Others” are persons outside the aircraft who were injured or killed.</p>
        <p><b>Item # 7:</b> Phase of flight may be taxiing for departure, take-off (can add specific leg of traffic circuit), cruising, landing (can add specific leg of traffic circuit), or taxiing after landing.</p>
        <p><b>Item # 8:</b> If the accident / incident occurred off airport, weather information of an airport within 20 nm radius may be used. Include identification of the airport in this item.</p>
        <p><b>Item # 10:</b> Preferably use terminologies found in list of incidents in: 
            <ul>
                <li>item d of PCAR Part 13 subpart IS 13.030</li>
                <li>items a and b of PCAR Part 13 subpart IS 13.175-1</li>
                <li>items in PCAR Part 13 subpart IS 13.175-2</li>
                <li>items in PCAR Part 13 subpart IS 13.175-3</li>
            </ul>
        </p>
        <p><b>Send the filled-out form to CAAP OPCEN thru:</b><br>
            Email: <a href="mailto:opcen@caap.gov.ph">opcen@caap.gov.ph</a><br>
            Viber / WhatsApp: (02) 968-870-4221
        </p>
    </details>
</div>

</body>
</html>

