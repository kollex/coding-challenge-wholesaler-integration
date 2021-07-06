### Little Convention for the IOC Container
- In case of injecting an Interface, 
the interface name must be the implementing class name suffixed with **Interface** (User**Interface**, Duck**Interface**, Megaman**Interface** ...) , and the implementation must be in the same path and namespace of the interface

 #### Example:
 - For a **Foo** class, the Interface name should be **FooInterface**