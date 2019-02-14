@extends('layouts.app')

@section('content')
<div class="_hc">
  <div class="_ol"></div>
  <div class="container relative">
    <h1>IELTS Writing Test Evaluation</h1>
    <div class="flex space-around">
      <p class="_sta"><span>Starting at only</span> <span class="_di">$2.99/Task</span></p>
    </div>
    <a href="#" class="btn btn-primary btn-lg">Start with Free Evaluation</a>
  </div>
</div>
<div class="_hiw">
  <div class="container">
    <h2>How do we assess IELTS Writing</h2>
    <ul>
      <li>
        <img src="{{ media('write.svg') }}" alt="">
        <div class="_he">
          Write an Essay
        </div>
        <div class="_de">
          Use paper to write your essay.
        </div>
      </li>
      <li>
        <img src="{{ media('scan.svg') }}" alt="">
        <div class="_he">
          Scan the paper & submit
        </div>
        <div class="_de">
          Readablity is important to assess the test.
        </div>
      </li>
      <li>
        <img src="{{ media('evaluate.svg') }}" alt="">
        <div class="_he">
          Writing Test Evaluation
        </div>
        <div class="_de">
          We evaluate work with defined criterias for IELTS Writing.
        </div>
      </li>
      <li>
        <img src="{{ media('result.svg') }}" alt="">
        <div class="_he">
          Test Results
        </div>
        <div class="_de">
          You will receive an email for confirmation of your results.
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="_pa">
  <div class="container">
    <h2>IELTS Writing Tasks Corrections</h2>
    <p>In order to ensure success, it is imperative for candidate to asses their writing abilities prior to real IELTS test. Assesing your own writing can be challenging and a tough task, hence you need an experienced teacher who evaluate your work.</p>
    <p>We have corrected thousands of IELTS essays and help number of candidates to embrace success.</p>
    <p>It is observed that candidates are repeatedly taking IELTS test due to less score in Writing module. This is the top reason why you should evaluate your essays with experienced IELTS teacher.</p>
    <div class="flex space-around">
      <a href="#" class="btn btn-secondary btn-lg">Know more about IELTS Writing Tasks Corrections</a>
    </div>
  </div>
</div>
<div class="_wt">
  <div class="container">
    <h2>What to expect in <span>feedback report</span></h2>
    <ul>
      <li>
        Individual band score for each criteria stated below,
        <ul>
          <li>Task Achievement</li>
          <li>Coherence & Cohesion</li>
          <li>Lexical Resources</li>
          <li>Grammatical range and accuracies</li>
        </ul>
      </li>
      <li>Corrections of errors</li>
      <li>Recommendations for better score</li>
      <li>Feedback Report in <strong>24 Hours</strong></li>
    </ul>
  </div>
</div>
<div class="_sr _pa text-center">
  <div class="container">
    <h2>Sample Feedback Report</h2>
    <p>Download sample evaluation report below.</p>
    <div class="flex space-around">
      <a href="#" class="btn btn-secondary btn-lg">Downlod Sample Feedback Report</a>
      <a href="#" class="btn btn-secondary btn-lg">Downlod Sample Feedback Report</a>
    </div>
  </div>
</div>
@endsection
