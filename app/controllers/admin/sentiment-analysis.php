<?php
// sentiment php file that is for creating the function only to get the sentiment results.
function SentimentAnalysis($text) {
    // For getting positive words
    $positiveWords = @file_get_contents(__DIR__ . '/../../../public/assets/lexicon-files/positive-words.txt');
    $positiveWords = $positiveWords ? explode("\n", $positiveWords) : []; // convert to array
    
    // For getting negative words
    $negativeWords = @file_get_contents(__DIR__ . '/../../../public/assets/lexicon-files/negative-words.txt');
    $negativeWords = $negativeWords ? explode("\n", $negativeWords) : []; // convert to array
    

    $words = str_word_count(strtolower($text), 1);
    $positiveCount = 0;
    $negativeCount = 0;
    
    // For counting all words needed for the final calculation of sentiment scores
    foreach ($words as $word) {
        if (in_array($word, $positiveWords)) {
            $positiveCount++;
        }
        if (in_array($word, $negativeWords)) {
            $negativeCount++;
        }
    }
    
    // Calculates until 100 or -100 limits
    $sentimentScore = 0;
    if ($positiveCount > 0 || $negativeCount > 0) {
        $total = $positiveCount + $negativeCount;
        $sentimentScore = round((($positiveCount - $negativeCount) / $total) * 100);
    }
    
    // Determine sentiment label
    $sentimentLabel = 'neutral';
    if ($sentimentScore > 10) {
        $sentimentLabel = 'positive';
    } elseif ($sentimentScore < -10) {
        $sentimentLabel = 'negative';
    }
    
    return [
        'sentiment_label' => $sentimentLabel,
        'sentiment_score' => $sentimentScore
    ];
}

?> 