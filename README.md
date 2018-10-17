# Scoresaber parser

Extract data from [scoresaber](http://scoresaber.com/)

## Usage

```php
<?php
use ScoreSaberApi\ProfileHandler;

$handler = new ProfileHandler();
$scores = $handler->getRecentScores('7656steamidxxx');
foreach($scores as $score) {
	echo $score->getSong()->getName() . ': ' . $score->getAccuracy();
}
```
