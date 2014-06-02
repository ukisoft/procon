
public class MyLinkedList
{

    private class Node
    {
        Object object = null;
        Node nextNode = null;

        Node(Object object)
        {
            this.object = object;
        }

        @Override
        public String toString()
        {
            return object.toString();
        }
    }

    private int size;
    private Node firstNode;

    MyLinkedList()
    {
        this.size = 0;
    }

    MyLinkedList(Object... objects)
    {
        this.size = objects.length;
        Node previousNode = null;
        for (int i = 0; i < objects.length; i++) {
            if (i == 0) {
                firstNode = previousNode = new Node(objects[i]);
            } else {
                Node nextNode = new Node(objects[i]);
                previousNode.nextNode = nextNode;
                previousNode = nextNode;
            }
        }
    }

    public boolean add(Object object)
    {
        if (this.size == 0) {
            this.firstNode = new Node(object);
            this.size++;
            return true;
        }

        Node nextNode = null;
        for (int i = 0; i < this.size - 1; i++) {
            if (i == 0) {
                nextNode = this.firstNode.nextNode;
            } else {
                nextNode = nextNode.nextNode;
            }
        }
        nextNode.nextNode = new Node(object);
        this.size++;
        return true;
    }

    public boolean contains(Object object)
    {
        Node nextNode = null;
        for (int i = 0; i < this.size - 1; i++) {
            if (i == 0) {
                if (this.firstNode.object == object) return true;
                nextNode = this.firstNode.nextNode;
            } else {
                if (nextNode.object == object) return true;
                nextNode = nextNode.nextNode;
            }
        }
        return false;
    }

    public Object get(int index)
    {
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        if (index == 0) return this.firstNode.object;

        Node nextNode = null;
        for (int i = 0; i < index; i++) {
            if (i == 0) {
                nextNode = this.firstNode.nextNode;
            } else {
                nextNode = nextNode.nextNode;
            }
        }
        return nextNode.object;
    }

    public Object set(int index, Object object)
    {
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        if (index == 0) {
            Node oldNode = this.firstNode;
            this.firstNode = new Node(object);
            this.firstNode.nextNode = oldNode.nextNode;
            return oldNode.object;
        }

        Node previousNode = null;
        Node oldNode = null;
        Node nextNode = null;
        for (int i = 0; i < index - 1; i++) {
            if (i == 0) {
                previousNode = this.firstNode;
            } else {
                previousNode = previousNode.nextNode;
                if (i == index - 2) {
                    oldNode = previousNode.nextNode;
                    nextNode = oldNode.nextNode;
                }
            }
        }

        previousNode.nextNode = new Node(object);
        previousNode.nextNode.nextNode = nextNode;
        return oldNode.object;
    }

    public int size()
    {
        return this.size;
    }

    public Object remove(int index)
    {
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        if (index == 0) {
            Node oldNode = this.firstNode;
            this.firstNode = oldNode.nextNode;
            this.size--;
            return oldNode.object;
        }

        Node previousNode = null;
        Node oldNode = null;
        Node nextNode = null;
        for (int i = 0; i < index - 1; i++) {
            if (i == 0) {
                previousNode = this.firstNode;
            } else {
                previousNode = previousNode.nextNode;
                if (i == index - 2) {
                    oldNode = previousNode.nextNode;
                    nextNode = oldNode.nextNode;
                }
            }
        }

        previousNode.nextNode = nextNode;
        this.size--;
        return oldNode.object;
    }

    public void insert(int index, Object object)
    {
        if (index == this.size) this.add(object);

        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        if (index == 0) {
            Node nextNode = this.firstNode;
            this.firstNode = new Node(object);
            this.firstNode.nextNode = nextNode;
            this.size++;
        }

        Node nextNode = null;
        Node previousNode = null;
        for (int i = 0; i < index; i++) {
            if (i == 0) {
                previousNode = this.firstNode;
            } else {
                previousNode = previousNode.nextNode;
                }
            if (i == index - 1) nextNode = previousNode.nextNode;
        }

        previousNode.nextNode = new Node(object);
        previousNode.nextNode.nextNode = nextNode;
        this.size++;
    }

    private boolean isIndexOutOfBounds(int index)
    {
        return index < 0 || index > this.size - 1;
    }

    @Override
    public String toString()
    {
        StringBuilder stringBuilder = new StringBuilder();
        Node previousNode = null;
        for (int i = 0; i < this.size; i++) {
            if (i == 0) {
                stringBuilder.append(this.firstNode);
                previousNode = this.firstNode;
            } else {
                previousNode = previousNode.nextNode;
                stringBuilder.append(", " + previousNode);
            }
        }
        return stringBuilder.toString() + "\n";

    }
}
