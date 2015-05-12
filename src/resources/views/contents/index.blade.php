@extends('layouts.master')

@section('title')
<title>Tech Study!（テックスタディ！） - サブタイトル</title>
@stop

@section('content')
    @include('components/event-list', ['eventSummaryList' => $eventSummaryList])
@stop
