# Resume

This is a sample very straight forward about DDD + CQRS.
 
It is totally framework independent and its intent is to explain this approach.

## DDD + CQRS terms:

The main terms used here are technically (and VERY shortly) explained above: 

- **Aggregate Root:**
  - Private constructor.
  - Generally it is an entity, like "User", "Product".
 
- **Entity:**
  - It has a lifecycle.
  - Can have its properties changed.

- **Value Object:**
  - Cannot be changed.
  - Only methods to retrieve information.

- **Domain Event:**
  - Generally triggered by an AggregateRoot.
  - They follow a timeline sequence.
 
- **Repository:**
  - Responsible to store and retrieve Entities from storage layer.
  - Persistence layer implementation cannot be exposed.
  
- **Services:**
  - Interacts with factories, repositories and entities to perform domain tasks.
  - Ideally should contain few (or better, just one) methods.
  - Follow Single Responsibility principle.
  
- **Command:**
  - Perform the write persistence tasks.
  - Command must not return any value, they are stateless.
    - **Command Handler:**
    - Receives command and perform actions with its payload. 
  
- **Query:**
  - Perform the read persistence tasks.
  - After you excute a command, you can use a query to watch its result.
    
- **Event Publisher:**
  - Publish all aggregate root events.