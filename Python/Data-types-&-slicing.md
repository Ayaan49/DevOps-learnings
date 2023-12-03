## Data Types

1. Lists: These are similar to arrays but these are heterogenous in nature whereas arrays are homogenous in nature. 

```python
a = [10, "Ayaan", 4.4] #heterogenous

b = [2, 5, 8] #homogenous
```

2. Tuple: It is an immutable data type represented inside “( )”

```python
a = (10, 3, 8,) #integers inside tuple
b = ([1,4], [3,0], [9,5]) #lists inside tuple
```
- The elements inside a tuple are immutable but if the elements inside that element are mutable then it can be changed:

![image](C:\Users\AYAAN BORDOLOI\Downloads\tuple.png)

3. Sets: Same as in maths. The duplicate values are removed. They are unordered pairs.

```python
a = { 10, 60, 47 }
```

4. Dictionary: It stores the data in the form of key value pair. It is also mutable.

```python
d = {
    
    mango: "King of fruits"
    lion: "King of the jungle"

}
```
Mango and lion are the keys and the rest are values.

## Slicing

In Python, slicing is a technique used to extract a portion of a sequence (such as a string, list, tuple, or other iterable) by specifying a range of indices. Slicing allows you to create a new sequence containing elements from the original sequence without modifying the original sequence.

![image](C:\Users\AYAAN BORDOLOI\Downloads\slicing.png)

- The first element is inclusive and the last element is exclusive.
- Slicing with a step:

```python
# Slicing with a step
numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
subset = numbers[1:9:2]  # Get every second element from index 1 to 9 (exclusive)
print(subset)  

# Output: [1, 3, 5, 7]
```
- Reversing through slicing:

![image](https://www.notion.so/Slicing-d1e065c4f3cf4d00b7a7142c2dbcb4b0?pvs=4#9719360dd1f4421daeb13feff46425e8)