# Executive Summary

The goal of this test assessment is to provide an opportunity for the selected candidate to proof the level of the technical skills and demonstrate the ability to put into practice the most critical and important development practices: OOP, Design Patterns, Unit Testing, Docker, Documentation.

The test task described in this document does not bring any commercial value and the outcome will not be reused for any project.

# Points of Attention

During the task execution it is highly recommended to pay attention to the following:

1. Following SOLID principles and industry standards in OOP.
2. Design Patterns utilization, but only in case they solve the particular problem.
3. Error handling.
4. Unit tests.
5. Docker technology utilization to speed up dev environment setup and execution of the useful commands.
6. Informative documentation.

# Task

Create the following reusable library in PHP OOP style without using any PHP framework.

Imagine a store where products have prices per unit but also volume prices. E.g., bananas may be £1.00 each or 5 for £3.00.

Create an API in the library that takes products in arbitrary order (similar to a checkout line) and then returns the correct final price for the entire shopping basket based on the prices as applicable.

Please use following products:

| **Code** | **Price** |
| --- | --- |
| **ZA** | £2.00 each or 4 for £7.00 |
| **YB** | £12.00 |
| **FC** | £1.25 or £6 for a six pack |
| **GD** | £0.15 |

A top-level point of sale terminal service is needed that looks something like this pseudo-code:

>$terminal-&gt;setPricing(...)<br/>$terminal-&gt;scanItem(&quot;ZA&quot;)<br/>$terminal-&gt;scanItem(&quot;FC&quot;)<br/>$result = $terminal-\&gt;getTotal()


It is up to you to design and implement the rest of the code as you wish, including how you specify the product prices.

Following test cases must be shown to work in your program:

1. Scan items in this order: ZA,YB,FC,GD,ZA,YB,ZA,ZA; Verify the total price is £32.40.

1. Scan items in this order: FC,FC,FC,FC,FC,FC,FC; Verify the total price is £7.25.
2. Scan items in this order: ZA,YB,FC,GD; Verify the total price is £15.40.

The developed code can be delivered in as a zip archive or as a link to public repository.