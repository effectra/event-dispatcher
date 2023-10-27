# Effectra Event Dispatcher

**Effectra\EventDispatcher** is a versatile and lightweight event dispatching library for PHP, designed to simplify the management of events within your application. It adheres to the PSR-14 standard, providing a consistent and extensible way to handle events, listeners, and event propagation.

## Features

- **PSR-14 Compliance:** Follows the PSR-14 standard for event dispatching, ensuring interoperability with other PHP packages and frameworks.
- **Stoppable Events:** Supports stoppable events, allowing events to be halted during propagation if necessary.
- **Flexible Listener Providers:** Easily register and manage listeners for specific events through a flexible listener provider interface.
- **Consistent Event Handling:** Ensures synchronous execution of listeners in the order they are registered.
- **Simplified API:** Provides a straightforward API for dispatching events, making it easy to integrate into your projects.

## Installation

You can install **Effectra\EventDispatcher** via Composer. Run the following command in your project directory:

```bash
composer require effectra/event-dispatcher
```

## Usage

### 1. Creating Events

Create your custom event classes by extending the `Effectra\EventDispatcher\Event` class. This base class implements the `Psr\EventDispatcher\StoppableEventInterface`, allowing events to be stoppable.

```php
namespace YourNamespace\Events;

use Effectra\EventDispatcher\Event;

class CustomEvent extends Event
{
    // Your event properties and methods
}
```

### 2. Registering Listeners

Create listeners by defining callable functions or classes implementing the necessary logic. Register listeners using the `Effectra\EventDispatcher\ListenerProvider` class.

```php
namespace YourNamespace;

use Effectra\EventDispatcher\ListenerProvider;
use YourNamespace\Events\CustomEvent;

// Create a listener provider
$listenerProvider = new ListenerProvider();

// Register a listener for the CustomEvent
$listenerProvider->addListener(CustomEvent::class, function (CustomEvent $event) {
    // Handle the CustomEvent
});

// Dispatching the event
$event = new CustomEvent();
$dispatcher = new EventDispatcher($listenerProvider);
$dispatcher->dispatch($event);
```

### 3. Stoppable Events

To create a stoppable event, use the `stopPropagation()` method within your event logic. This will prevent further listeners from being executed.

```php
namespace YourNamespace\Events;

use Effectra\EventDispatcher\Event;

class StoppableEvent extends Event
{
    public function process(): void
    {
        // Your event processing logic

        // Stop further propagation if a condition is met
        if ($condition) {
            $this->stopPropagation();
        }
    }
}
```

## Contributing

Contributions are welcome! Fork the repository, create a branch, make your changes, and then create a pull request. Please ensure your PR description clearly describes the changes you made.

## License

This package is licensed under the [MIT License](LICENSE).
