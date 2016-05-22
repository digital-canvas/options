# States Options

Used to create lists of US and CA states/provinces.

## Installation

```
composer require digital-canvas/options-states
```

## Usage

### Create an array with state abbreviations as keys and full names as values

```
// US states only
$states = \DigitalCanvas\Options\States::getPairs(['US']);
// US states and CA provinces
$states = \DigitalCanvas\Options\States::getPairs(['US', 'CA']);
```

### Create an array with abbreviations as keys and full array of state data as values

```
// US states only
$states = \DigitalCanvas\Options\States::getArray(['US']);
// US states and CA provinces
$states = \DigitalCanvas\Options\States::getArray(['US', 'CA']);
```

### Create a `<select>` list for state selection

```
<select name="state">
  <?php foreach(\DigitalCanvas\Options\States::getPairs(['US']) as $abbr => $label):?>
    <option value="<?php echo htmlspecialchars($abbr);?>"><?php echo htmlspecialchars($label);?></option>
  <?php endforeach; ?>
</select>
```
