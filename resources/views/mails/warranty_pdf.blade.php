<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Warranty Registration</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #3A0265; margin: 0; padding: 0; }
        .container { padding: 15px; }
        .header { text-align: center; margin-bottom: 15px; }
        .header img { max-height: 60px; margin-bottom: 5px; }
        .header h1 { color: #FF0054; margin: 0; font-size: 22px; }
        .details { margin-top: 15px; }
        .section-title { background-color: #FF0054; color: #fff; padding: 6px 10px; font-weight: bold; margin-top: 12px; border-radius: 4px; font-size: 12px; }
        .row { display: flex; margin-top: 8px; }
        .col { flex: 1; padding: 3px 8px; }
        .label { font-weight: bold; color: #3A0265; }
        .value { color: #3A0265; }
        .coverage-box { border: 2px solid #FF0054; border-radius: 5px; padding: 8px; margin-top: 15px; font-size: 10px; }
        .coverage-title { text-align: center; font-weight: bold; color: #FF0054; margin-bottom: 8px; font-size: 12px; }
        .reference { margin-top: 6px; font-size: 10px; color: #3A0265; }
        .terms { margin-top: 15px; font-size: 10px; line-height: 1.4; color: #3A0265; }
        .terms ol { padding-left: 20px; }
        .footer { text-align: center; margin-top: 15px; font-size: 10px; color: #3A0265; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('assets/images/veloskin.png') }}" alt="Logo">
            <h1>VELOSKIN PPF</h1>
            <p>Warranty Registration Details</p>
        </div>

        <!-- Customer & Dealer Details -->
        <div class="details">
            <div class="section-title">Customer & Dealer Info</div>
            <div class="row">
                <div class="col"><span class="label">Customer Name:</span> <span class="value">{{ $warranty->customer_name }}</span></div>
                <div class="col"><span class="label">Dealer Name:</span> <span class="value">{{ $warranty->dealer_name }}</span></div>
            </div>
            <div class="row">
                <div class="col"><span class="label">Dealer Phone:</span> <span class="value">{{ $warranty->dealer_phone_number }}</span></div>
                <div class="col"><span class="label">Area:</span> <span class="value">{{ $warranty->area }}</span></div>
            </div>
            <div class="row">
                <div class="col"><span class="label">Body Parts:</span> <span class="value">{{ $warranty->body_parts }}</span></div>
                <div class="col"><span class="label">Email:</span> <span class="value">{{ $warranty->email }}</span></div>
            </div>
        </div>

        <!-- Product & Vehicle Details -->
        <div class="details">
            <div class="section-title">Product & Vehicle Info</div>
            <div class="row">
                <div class="col"><span class="label">Product:</span> <span class="value">{{ $warranty->product_id }}</span></div>
                <div class="col"><span class="label">Serial Number:</span> <span class="value">{{ $warranty->serial_number }}</span></div>
            </div>
            <div class="row">
                <div class="col"><span class="label">Vehicle Number:</span> <span class="value">{{ $warranty->vehicle_number }}</span></div>
                <div class="col"><span class="label">Phone Number:</span> <span class="value">{{ $warranty->phone_number }}</span></div>
            </div>
            <div class="row">
                <div class="col"><span class="label">Address:</span> <span class="value">{{ $warranty->address }}</span></div>
                <div class="col"><span class="label">Expiry Date:</span> <span class="value">{{ $warranty->expiry_date }}</span></div>
            </div>
        </div>

        <!-- Coverage Details Box -->
        <div class="coverage-box">
            <div class="coverage-title">____________________________Coverage Details____________________________</div>
            <div class="row">
                <div class="col"><span class="label">Area:</span> <span class="value">{{ $warranty->area }}</span></div>
                <div class="col"><span class="label">Body Parts:</span> <span class="value">{{ $warranty->body_parts }}</span></div>
            </div>
            <div class="reference">
                Reference: {{ date('Ym') }}{{ $warranty->id }} <br>
                Transaction Date: {{ date('d-m-Y') }}
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="terms">
            <strong>Terms & Conditions:</strong>
            <ol>
                <li>This Contract is valid for one calendar year from the date of payment of the requisite fees. Short tenure contracts for less than a year are not permitted.</li>
                <li>This Contract is valid only for Accidental Damages to the product installed as per this contract. Replacements or upgrades or minor repairs initiated due to causes other than accidental damages are not covered. No other vehicle components are covered under this Contract. Damages of any kind either to the vehicle mentioned in this contract or to any occupants or any other third-party bodily injury, damage, or death are not covered.</li>
                <li>Only Cashless benefit is extended under this contract and is valid at the same dealership/vendor/network partner where the initial installation was completed.</li>
                <li>Repairs/Replacements taken up by the customer for any reason whatsoever with or without intimation at dealerships/vendors other than where the installation was completed are not covered.</li>
                <li>Customer can avail benefits of this cover only for the same quality/grade or lower material to be replaced and at the same replacement value as agreed under this contract.</li>
                <li>The number of times the service can be availed each year is restricted to 3 and the maximum claim value each year at the aggregated level cannot exceed the agreed installed value.</li>
            </ol>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} VELOSKIN PPF. All rights reserved.
        </div>
    </div>
</body>
</html>
