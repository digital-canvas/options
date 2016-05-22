# States Options

[![Latest Stable Version](https://poser.pugx.org/digital-canvas/options/v/stable)](https://packagist.org/packages/digital-canvas/options)
[![Total Downloads](https://poser.pugx.org/digital-canvas/options/downloads)](https://packagist.org/packages/digital-canvas/options)
[![License](https://poser.pugx.org/digital-canvas/options/license)](https://packagist.org/packages/digital-canvas/options)
[![Build Status](https://travis-ci.org/digital-canvas/options.svg?branch=master)](https://travis-ci.org/digital-canvas/options)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/digital-canvas/options/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/digital-canvas/options/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/digital-canvas/options/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/digital-canvas/options/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/digital-canvas/options/badges/build.png?b=master)](https://scrutinizer-ci.com/g/digital-canvas/options/build-status/master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/284169f3-f44a-4b15-9828-b9eb67c370e2/mini.png)](https://insight.sensiolabs.com/projects/284169f3-f44a-4b15-9828-b9eb67c370e2)

Used to create lists of countries and US and CA states/provinces.

## Installation

```
composer require digital-canvas/options
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
