## Python

Python is a procedural, object oriented (oops), and functional language. Everything inside python is an object. It is a dynamic language, we don’t need to define the datatype of the variable unlike static language like C, C++, Java.

### Installation

- [Download](https://www.python.org/downloads/) and install python.

### Memory

- There are two kinds of memory in programming languages, stack memory and heap memory.
- In stack memory, the reference variable is stored and in heap memory the object is stored.
  ![image](https://1.bp.blogspot.com/-gKWUcwIKWWU/VvPtKUAIFjI/AAAAAAAAFRc/WLCqWfSxlZ4ioocmBuFS3KaRhzs0I13OA/w1200)
-  In Python, when you compare two variables using the "is" operator, you are checking if they refer to the same object in memory, not if their values are the same. When you assign the same value (e.g., 10) to two variables a and b, Python often optimizes memory usage by having them both point to the same object representing that value. This is known as interning.

```python 
a = 10
b = 10
a is b
```
You get `True` because both a and b are referring to the same object representing the integer 10.

- However, when you change the value to 4555:

```python
a = 4555
b = 4555
a is b
```
You get `False` because, in this case, Python does not intern larger integer values, and a and b refer to different objects in memory that happen to have the same value.

- In general, you should use the "==" operator for value comparisons, not "is." For example:

```python
a = 10
b = 10
a == b  # This will always be True for integers with the same value

a = 4555
b = 4555
a == b  # This will be True as well because you are comparing their values
```
The "is" operator is mainly used to check if two variables are referring to the exact same object in memory, which may not always be the case for objects with the same value, especially for larger integers or other complex objects.

- Size of integer in python depends on the ram in the computer. Hence, python is a slow language compared to other language.

### Garbage Collection

- Garbage collection in Python is the process by which the interpreter automatically manages the memory used by objects that are no longer needed in a program. In Python, memory management is mostly transparent to the programmer, thanks to the use of reference counting and a cyclic garbage collector.

- Python's garbage collector, including both reference counting and the cyclic garbage collector, works in the background to identify objects that are no longer reachable and frees up their memory. This ensures that your program doesn't leak memory and uses resources efficiently.