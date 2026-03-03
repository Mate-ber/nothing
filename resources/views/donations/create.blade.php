<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate to Nothing</title>
</head>
<body>
<h1>Donate to Nothing</h1>

<form method="POST" action="{{ route('donations.store') }}">
    @csrf

    <div>
        <label for="campaign_id">Campaign</label>
        <input type="text" id="campaign_id" name="campaign_id" value="{{ old('campaign_id', 'nothing-general') }}">
    </div>

    <div>
        <label for="amount">Amount (in dollars)</label>
        <input type="number" id="amount" name="amount" min="1" step="0.01" value="{{ old('amount', '5.00') }}">
    </div>

    <button type="submit">Donate</button>
</form>
</body>
</html>
