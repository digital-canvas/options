# States Options

[![Latest Stable Version](https://poser.pugx.org/digital-canvas/options-states/v/stable)](https://packagist.org/packages/digital-canvas/options-states)
[![Total Downloads](https://poser.pugx.org/digital-canvas/options-states/downloads)](https://packagist.org/packages/digital-canvas/options-states)
[![License](https://poser.pugx.org/digital-canvas/options-states/license)](https://packagist.org/packages/digital-canvas/options-states)
[![Build Status](https://travis-ci.org/digital-canvas/options-states.svg?branch=master)](https://travis-ci.org/digital-canvas/options-states)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/digital-canvas/options-states/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/digital-canvas/options-states/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/digital-canvas/options-states/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/digital-canvas/options-states/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/digital-canvas/options-states/badges/build.png?b=master)](https://scrutinizer-ci.com/g/digital-canvas/options-states/build-status/master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/284169f3-f44a-4b15-9828-b9eb67c370e2/mini.png)](https://insight.sensiolabs.com/projects/284169f3-f44a-4b15-9828-b9eb67c370e2)

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
