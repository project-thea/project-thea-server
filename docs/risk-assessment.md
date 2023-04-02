# Risk Assessment 

Risk assement involves the detection of potention hotspots, assessing positve tests and generating 
and exposure list for notification. To do this the commands below need to be schduled to run
at regular intervals depending on the project requirements such as the frequency of test collection.

```
artisan risk-assessment:compute
artisan risk-assessment:tests
artisan hotspots:process
```