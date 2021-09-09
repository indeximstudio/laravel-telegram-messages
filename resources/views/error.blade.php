<b>🔴 Error{{ isset($h1) ? " {$h1}" : '' }}</b>{{ isset($h2) ? "\n{$h2}" : '' }}{!! !empty($text) ? "\n{$text}" : '' !!}
<b>{{ isset($source) ? $source : config('app.url') }}</b>
